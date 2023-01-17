<?php

namespace app\controllers;

use app\models\LocalesMantenimiento;
use app\models\LocalesMantenimientoSearch;
use app\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Configuracion;

use Yii;

/**
 * LocalesMantenimientoController implements the CRUD actions for LocalesMantenimiento model.
 */
class LocalesMantenimientoController extends \yii\web\Controller
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
     * Lists all LocalesMantenimiento models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();
        
        $searchModel = new LocalesMantenimientoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LocalesMantenimiento model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LocalesMantenimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();
        
        $model = new LocalesMantenimiento();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LocalesMantenimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
			return $this->goHome();
        
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LocalesMantenimiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        if(Yii::$app->user->isGuest || !Usuario::esRolAdmin(Yii::$app->user->id))
            return $this->goHome();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LocalesMantenimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LocalesMantenimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LocalesMantenimiento::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
