<?php

namespace app\controllers;

use app\models\Configuracion;
use app\models\ConfiguracionesSearch;
use app\models\Usuario;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfiguracionesController implements the CRUD actions for Configuracion model.
 */
class ConfiguracionesController extends Controller
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
     * Lists all Configuracion models.
     *
     * @return string
     */
    public function actionIndex()
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			$searchModel = new ConfiguracionesSearch();
			$dataProvider = $searchModel->search($this->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}else
			$this->goHome();
    }

    /**
     * Displays a single Configuracion model.
     * @param string $variable Variable
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($variable)
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			return $this->render('view', [
				'model' => $this->findModel($variable),
			]);
		}else
			$this->goHome();
    }

    /**
     * Creates a new Configuracion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			$model = new Configuracion();

			if ($this->request->isPost) {
				if ($model->load($this->request->post()) && $model->save()) {
					return $this->redirect(['view', 'variable' => $model->variable]);
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
     * Updates an existing Configuracion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $variable Variable
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($variable)
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			$model = $this->findModel($variable);

			if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
				return $this->redirect(['view', 'variable' => $model->variable]);
			}

			return $this->render('update', [
				'model' => $model,
			]);
		}else
			$this->goHome();
    }

    /**
     * Deletes an existing Configuracion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $variable Variable
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($variable)
    {
		if(Usuario::esRolSistema(Yii::$app->user->id) || Usuario::esRolAdmin(Yii::$app->user->id)){

			$this->findModel($variable)->delete();

			return $this->redirect(['index']);
		}else
			$this->goHome();
    }

    /**
     * Finds the Configuracion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $variable Variable
     * @return Configuracion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($variable)
    {
        if (($model = Configuracion::findOne(['variable' => $variable])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
