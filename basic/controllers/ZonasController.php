<?php

namespace app\controllers;

use app\models\Zonas;
use app\models\ZonasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//Añade esto para el tema de paginador y roles
use app\models\Configuracion;
use app\models\UsuarioAviso;
use yii\data\Pagination;

//para el tema de roles

use app\models\UsuarioRol;

//Para la parte de Angel
use app\models\Usuario;
use Yii;


/**
 * ZonasController implements the CRUD actions for Zonas model.
 */
class ZonasController extends Controller
{
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
     * Lists all Zonas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Solo los admins debes ser capaz de meterse aquí
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            $searchModel = new ZonasSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new NotFoundHttpException('No tiene permiso');
        }
    }

    /**
     * Displays a single Zonas model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new NotFoundHttpException('No tiene permiso');
        }
    }

    /**
     * Creates a new Zonas model.
     * Se comprueba que el tipo de zona 
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            $model = new Zonas();

            if ($this->request->isPost) {
                //Comprobar los datos que llegan por post:
                $model->load($this->request->post());       
                //si los datos no son validos o no se puede guardar     
                if ($model->ComprobarDatos() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } 
            } else {
                $model->loadDefaultValues();
                
            }

            return $this->render('create', [
                'model' => $model,
            ]);
            
        } else {
            throw new NotFoundHttpException('No tiene permiso');
        }
    }
    

    /**
     * Updates an existing Zonas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            $model = $this->findModel($id);

            if ($this->request->isPost) {
                //Comprobar los datos que llegan por post:
                $model->load($this->request->post());       
                //si los datos no son validos o no se puede guardar     
                if ($model->ComprobarDatos() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } 
            } else {
                $model->loadDefaultValues();
                
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('No tiene permiso');
        }
    }

    /**
     * Deletes an existing Zonas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('No tiene permiso');
        }
    }

    /**
     * Finds the Zonas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Zonas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zonas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
