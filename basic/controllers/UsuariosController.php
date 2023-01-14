<?php

namespace app\controllers;

use app\models\Usuario;
use app\models\Usuarioaviso;
use app\models\UsuarioRol;
use app\models\UsuariosSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuario model.
 */
class UsuariosController extends Controller
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
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){
			$searchModel = new UsuariosSearch();
			$dataProvider = $searchModel->search($this->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}else
			$this->goHome();
    }

	public function actionConfirmarusuarios($id=null){

		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			if(isset($id) && $id!=null){
				$model = $this->findModel($id);
				$model->confirmado=1;
				$model->save();
			}

			$searchModel = new UsuariosSearch();
			$dataProvider = $searchModel->search($this->request->queryParams);
			$dataProvider->query->where(['confirmado'=>0])->all();

			return $this->render('confirmar', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);

		}else
			$this->goHome();
	}

    /**
     * Displays a single Usuario model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}else
			$this->goHome();
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			$model = new Usuario();

			if ($this->request->isPost) {
				if ($model->load($this->request->post())) {
					$model->password=hash("sha1", $model->password);	//Se genera la nueva contraseña cifrada
					if($model->save()){
						return $this->redirect(['view', 'id' => $model->id]);
					}

				}
			} else {
				$model->loadDefaultValues();
			}

			return $this->render('create', [
				'model' => $model,
			]);
		}else
			$this->goHome();
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
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

			return $this->render('update', [
				'model' => $model,
			]);
		}else
			$this->goHome();
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			$this->findModel($id)->delete();

			return $this->redirect(['index']);
		}else
			$this->goHome();
    }

	public function actionRbac($id=null, $rol=null, $accion=null){

		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			//Se comprueba si llegan id y rol por url para actualizar el rol del usuario dado
			if(isset($id) && $id!=null && isset($rol) && $rol!=null && isset($accion) && $accion!=null && ($accion==1 || $accion==0)){
				$model = $this->findModel($id);

				//Comprobar si existe
				$comprobar=UsuarioRol::find()->where(['id_usuario'=>$id, 'id_rol'=>$rol]);

				//Si existe hay que borrarlo
				if($comprobar->count()==1 && $accion==0){
					$comprobar->one()->delete();

				}else if($comprobar->count()!=1 && $accion==1){
					//Si no existe se crea
					$relacion=new UsuarioRol();
					$relacion->id_usuario=$id;
					$relacion->id_rol=$rol;
					$relacion->save();
				}
			}

			$searchModel = new UsuariosSearch();
			$dataProvider = $searchModel->search($this->request->queryParams);

			return $this->render('rbac', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}else
			$this->goHome();
	}

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionMiPerfil()
	{
        $id = $_SESSION['_id']; //id del usuario_origen

        //-Datos del usuario
        $modelUsuario = Usuario::findOne(['id' => $id]);
        //-Avisos relacionados con el usuario
		$modelAvisosEnviados= UsuarioAviso::getAvisosEnviados($id);
		var_dump($modelAvisosEnviados);

        //$modelAvisos= Usuarioaviso::findOne($id);
       // return $this->render('miperfil', [
         //   'modelUsuario' => $modelUsuario,
        //    'id' => $id,
		//	]);
    }
}
