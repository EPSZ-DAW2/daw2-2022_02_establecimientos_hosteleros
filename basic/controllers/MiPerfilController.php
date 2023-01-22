<?php

namespace app\controllers;

use app\models\Hostelero;
use app\models\Local;
use app\models\Registro;
use app\models\ChangePasswordForm;
use app\models\Usuario;
use app\models\UsuarioAviso;
use app\models\UsuarioRol;
use app\models\UsuariosLocales;
use app\models\UsuariosSearch;
use app\models\UsuarioQuery;
use app\models\UsuarioAvisoSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuario model.
 */
class MiPerfilController extends Controller
{
    /*
    * Función sobreescrita para comprobar que layout usar
    * y que homeUrl definir según el rol del usuario
    * */
   public function beforeAction($action)
   {
       if(!Yii::$app->user->isGuest){
           if(Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id)){
               $this->layout='privada';
               Yii::$app->homeUrl=array('usuarios/index');
           }

       }else{
           $this->layout='publica';
           Yii::$app->homeUrl=array('local/index');
       }

       return parent::beforeAction($action);
   }


    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Usuario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $id = $_SESSION['__id']; //id del usuario_origen
        if($id==null) {
            $this->layout='publica';
            Yii::$app->homeUrl=array('local/index');
        }
        //-Datos del usuario
        $searchModelUsuario = new UsuariosSearch();
        $modelUsuario = $searchModelUsuario->findIdentity($id);



        //$modelAvisos= Usuarioaviso::findOne($id);
        return $this->render('miperfil', [
            'modelUsuario' => $modelUsuario,
        ]);
    }

    public function actionMensajes(){
        $id = $_SESSION['__id']; //id del usuario_origen
        if($id==null) {
            $this->layout='publica';
            Yii::$app->homeUrl=array('local/index');
        }
        $enviados= Yii::$app->request->post('enviados');
        $recibidos= Yii::$app->request->post('recibidos');
        /*$params = Yii::$app->request->bodyParams;
        $enviados = $params['enviados'];
        $recibidos = $params['recibidos'];*/
        //-Avisos relacionados con el usuario
        $searchModelAvisosEnviados = new Usuarioaviso();
        if($enviados ==null){
            $modelAvisosEnviados= $searchModelAvisosEnviados->getAvisosEnviados($id);
        }elseif ($enviados =='leido'){
            $modelAvisosEnviados= $searchModelAvisosEnviados->getAvisosEnviadosLeidos($id);
        }elseif ($enviados =='no-leido'){
            $modelAvisosEnviados= $searchModelAvisosEnviados->getAvisosEnviadosNoLeidos($id);
        }else{
            $modelAvisosEnviados= $searchModelAvisosEnviados->getAvisosEnviados($id);
        }
        $searchModelAvisosRecibidos = new Usuarioaviso();

        if($recibidos==null){
            $modelAvisosRecibidos= $searchModelAvisosRecibidos->getAvisosRecibidos($id);
        }elseif ($recibidos=='leido'){
            $modelAvisosRecibidos= $searchModelAvisosEnviados->getAvisosRecibidosLeidos($id);
        }elseif ($recibidos=='no-leido'){
            $modelAvisosRecibidos= $searchModelAvisosEnviados->getAvisosRecibidosNoLeidos($id);
        }else{
            $modelAvisosRecibidos= $searchModelAvisosRecibidos->getAvisosRecibidos($id);
        }


        return $this->render('mensajes', [
            'modelAvisosEnviados'=>$modelAvisosEnviados,
            'modelAvisosRecibidos'=>$modelAvisosRecibidos,
        ]);
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $datos= (isset($_POST['UsuariosSearch']) ? $_POST['UsuariosSearch'] : NULL);

        echo '<br>';
        $id=(isset($datos['id']) ? (int)$datos['id'] : NULL); 
        //var_dump($id);
        //die();
        $model= Usuario::findOne($id);
        $model->email=(isset($datos['email']) ? $datos['email'] : NULL);
        $model->nick=(isset($datos['nick']) ? $datos['nick'] : NULL);
        $model->nombre =(isset($datos['nombre']) ? $datos['nombre'] : NULL);
        $model->apellidos = (isset($datos['apellidos']) ? $datos['apellidos'] : NULL);
        $model->fecha_nacimiento= (isset($datos['fecha_nacimiento']) ? $datos['fecha_nacimiento'] : NULL);
        $model->direccion = (isset($datos['direccion']) ? $datos['direccion'] : NULL);
        $model->zona_id = (isset($datos['zona_id']) ? $datos['zona_id'] : 0);
        $model->fecha_registro = (isset($datos['fecha_registro']) ? $datos['fecha_registro'] : NULL);

        $model->save();

        return $this->redirect(['index']);
    }

    public function actionUpdatecontra()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $id = $_SESSION['__id'];
            $modeluser=Usuario::findOne(['id' => $id]);
            if($modeluser->validatePassword($model->password)){
                return $this->render('cambiar_contra', ['model' => $model]);
            }
            $hash=hash("sha1", $model->password);
            $modeluser->password=$hash;
            $modeluser->save();
            return $this->redirect(['mi-perfil/index']);
        }

        return $this->render('cambiar_contra', ['model' => $model]);
    }

    public function actionCrearmensaje()
    {
        $model = new Usuarioaviso();

        $user = $_SESSION['__id']; //id del origen_usuario_id
        $model->origen_usuario_id = $user;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['mensajes', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('crearmensaje', ['model' => $model,]);
    }

    public function actionLeer($id){

        $model = Usuarioaviso::findOne(['id' => $id]);
        $iduser = $_SESSION['__id'];

        if($iduser==$model->destino_usuario_id && $model->fecha_lectura == null)
        {

            $fecha_lectura = date('Y-m-d H:i:s');
            $model->fecha_lectura = $fecha_lectura;
            $model->save();
        }

        return $this->render('leer', [
            'model' => $model,
        ]);
    }

    public function actionDesleer($id)
    {
        $model= new Usuarioaviso();

        $model->desleer($id);


        return $this->redirect(['mensajes']);
    }
    public function actionDesleermsg($id)
    {

        $model = Usuarioaviso::findOne(['id' => $id]);
        $model->desleer($id);
        $model->fecha_lectura=null;

        return $this->render('leer', [
            'model' => $model,
        ]);
    }

    public function actionBaja($id){
        UsuarioAviso::generarBaja($id);
        return $this->redirect(['index']);
    }

    public function actionEstablecimientos(){
        $id = $_SESSION['__id'];
        $modellocal=Local::findAll(['crea_usuario_id' => $id]);

        return $this->render('local', [
            'locales'=>$modellocal,
        ]);
    }

    public function actionComentarios(){
        $id = $_SESSION['__id'];
        $model=NULL;
        //Descomentar cuando se haga el modelo Comentario
        //$model=Comentario::findAll(['comentario_id' => $id]);
       
        return $this->render('comentarios', [
            'comentarios'=>$model,
        ]);
    }

    public function actionActualizar(){
        $datos= (isset($_POST['Local']) ? $_POST['Local'] : NULL);
        $id=(isset($datos['id']) ? $datos['id'] : null);

        if($id==null){
            return $this->redirect(['mi-perfil/establecimientos']);
        }

        $model= Local::findOne($id);

        $model->titulo=(isset($datos['titulo']) ? $datos['titulo'] : $model->titulo);
        $model->descripcion=(isset($datos['descripcion']) ? $datos['descripcion'] : $model->descripcion);
        $model->lugar=(isset($datos['lugar']) ? $datos['lugar'] : $model->lugar);
        $model->url=(isset($datos['url']) ? $datos['url'] : $model->url);
        $model->categoria_id=(isset($datos['categoria_id']) ? $datos['categoria_id'] : $model->categoria_id);
        $model->imagen_id=(isset($datos['imagen_id']) ? $datos['imagen_id'] : $model->imagen_id);
        $model->visible=(isset($datos['visible']) ? $datos['visible'] : $model->visible);
        $model->cerrado_comentar=(isset($datos['cerrado_comentar']) ? $datos['cerrado_comentar'] : $model->cerrado_comentar);
        $model->cerrado_quedar=(isset($datos['cerrado_quedar']) ? $datos['cerrado_quedar'] : $model->cerrado_quedar);
        if($model->cerrado_quedar){
            //Se ejecutan los avisos a los usuarios que sigan el local
            $usuarios=UsuariosLocales::findAll(['local_id' => $id]);
            foreach ($usuarios as $usuario){
                UsuarioAviso::generarMensaje(null,$usuario->usuario_id,'A','Se ha eliminado la quedada',$id);
            }
        }
        $model->save();
        $error=$model->getErrors();
        if(isset($erro)){
            Registro::generarerror("Error al guardar".$model->id);
        }
        return $this->redirect(['mi-perfil/establecimientos']);
    }

    public function actionSeguimiento(){
        $id = $_SESSION['__id'];

        $models=UsuariosLocales::findAll(['usuario_id'=>$id]);
        return $this->render('seguimiento', [
            'models'=>$models,
        ]);


    }
}