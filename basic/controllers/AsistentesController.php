<?php

namespace app\controllers;

use app\models\Asistente;
use app\models\AsistenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//Para la parte de Angel
use app\models\Usuario;
use Yii;

/**
 * AsistentesController implements the CRUD actions for Asistente model.
 */
class AsistentesController extends Controller
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
     * Lists all Asistente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AsistenteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asistente model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Asistente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id,$id_local)
    {
        $model = new Asistente();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['convocatoria/index', 'id' => $model->id]);
            }
        } 

        return $this->render('create', [
            'model' => $model,'convocatoria' =>$id, 'local' => $id_local,
        ]);
    }



    /**
     * Deletes an existing Asistente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['convocatoria/index']);
    }

    /**
     * Finds the Asistente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Asistente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asistente::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
  /*  public function actionVer($id,$id_local)
       
    {     
        $searchModel = new AsistenteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->where(['convocatoria_id' =>$id]);

          $asistente=$dataProvider;
       // $Convocatoria = Convocatoria::findOne($id);
       // $asistente = $Convocatoria->asistentes;
         $model= $asistente;
        
          
            return $this->render('ver_asistentes', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,'model' => $model,'convocatoria'=>$id,'local'=>$id_local]);
        

    }*/
}
