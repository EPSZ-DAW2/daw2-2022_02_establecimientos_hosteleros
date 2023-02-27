<?php

namespace app\controllers;

use app\models\Local;
use app\models\Usuarioaviso;
use app\models\UsuarioavisoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;
use Yii;

/**
 * UsuarioavisoController implements the CRUD actions for Usuarioaviso model.
 */
class UsuarioavisoController extends Controller
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
     * Lists all Usuarioaviso models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioavisoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
        //return $this->render('vista_aviso', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarioaviso model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user = $_SESSION['__id']; //id del destino_usuario_id
        
        if($user==$model->destino_usuario_id && $model->fecha_lectura == null)
        {
            $fecha_lectura = date('Y-m-d H:i:s');
            $model->fecha_lectura = $fecha_lectura;
            $model->save();
        } 
        return $this->render('view', [
            'model' => $model,
            //'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuarioaviso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Usuarioaviso();

        $user = $_SESSION['__id']; //id del origen_usuario_id
        $model->origen_usuario_id = $user;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $nombre = $model->nombreUsuarioInv;
                $titulo = $model->nombreLocalInv;
                $model->destino_usuario_id = Usuario::find()->select('id')->where(['nick' => $nombre])->scalar();
                $model->local_id = Local::find()->select('id')->where(['Titulo' => $titulo])->scalar();
                if ($model->destino_usuario_id == null && $model->local_id == null) {
                    return $this->render('create', ['model' => $model, 'msgError' => 'El usuario o local no existe']);
                } else if ($model->destino_usuario_id != null || $model->local_id != null) {
                    if ($model->destino_usuario_id == null) {
                        $model->destino_usuario_id = 0;
                    }
                    if ($model->local_id == null) {
                        $model->local_id = 0;
                    }

                    $model->fecha_aviso = date('Y-m-d H:i:s');
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'msgError'=>null,
        ]);
    }



    /**
     * Updates an existing Usuarioaviso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usuarioaviso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDesleer($id)
    {
        $model = $this->findModel($id);
        $model->fecha_lectura=null;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Usuarioaviso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAceptar($id)
    {
        $model = $this->findModel($id);
        $fecha_aceptado = date('Y-m-d H:i:s');
        $model->fecha_aceptado= $fecha_aceptado;

        $idUsuario = $_SESSION['__id']; //id del usuario_destino
        $model->destino_usuario_id= $idUsuario;

        $model->save();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuarioaviso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuarioaviso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuarioaviso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarioaviso::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


}
