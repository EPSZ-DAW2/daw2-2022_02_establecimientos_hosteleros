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
		if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();

        $searchModel = new ConfiguracionesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Configuracion model.
     * @param string $variable Variable
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($variable)
    {
		if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();

        return $this->render('view', [
            'model' => $this->findModel($variable),
        ]);
    }

    /**
     * Creates a new Configuracion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
		if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();

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
		if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();

        $model = $this->findModel($variable);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'variable' => $model->variable]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
		if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();

        $this->findModel($variable)->delete();

        return $this->redirect(['index']);
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
