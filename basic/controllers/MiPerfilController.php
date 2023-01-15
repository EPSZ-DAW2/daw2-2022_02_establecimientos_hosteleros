<?php

namespace app\controllers;

use app\models\Usuario;
use app\models\UsuarioAviso;
use app\models\UsuarioRol;
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
        //-Avisos relacionados con el usuario
        $searchModelAvisosEnviados = new Usuarioaviso();
        $modelAvisosEnviados= UsuarioAviso::getAvisosEnviados($id);


        //$modelAvisos= Usuarioaviso::findOne($id);
        return $this->render('miperfil', [
            'modelUsuario' => $modelUsuario,
            'modelAvisosEnviados'=>$modelAvisosEnviados,

        ]);
    }

    /**
     * Updates an existing Usuarioaviso model.
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
        $error=$model->getErrors();
        //var_dump($error);
        //Yii::$app->end();
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatecontra($id)
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			$model = $this->findModel($id);
			$contraAnterior=$model->password;
			if ($this->request->isPost && $model->load($this->request->post())){
				//Se comprueba si la contraseña introducida es distinta a la anterior
				if(strcmp($contraAnterior, $this->request->post('Usuario')['password'])!=0)
					$model->password=hash("sha1", $model->password);	//Se genera la nueva contraseña cifrada

				//Se guarda el modelo
				if($model->save())
					return $this->redirect(['view', 'id' => $model->id]);

			}

			return $this->render('miperfil', [
				'model' => $model,
			]);
		}else
			$this->goHome();
    }

    public function actionLeer($id){

        $model = Usuarioaviso::findOne(['id' => $id]);

        if($user==$model->destino_usuario_id && $fecha_lectura == null)
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


        return $this->redirect(['index']);
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

}