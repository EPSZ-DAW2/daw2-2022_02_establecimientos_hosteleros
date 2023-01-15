<?php

namespace app\controllers;
use app\models\Asistente;
use app\models\AsistenteSearch;
use app\models\Convocatoria;
use app\models\ConvocatoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConvocatoriaController implements the CRUD actions for Convocatoria model.
 */
class ConvocatoriaController extends Controller
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
     * Lists all Convocatoria models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConvocatoriaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Convocatoria model.
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
     * Creates a new Convocatoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Convocatoria();

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
     * Updates an existing Convocatoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $timestamp = time()-(60*60*4);
        $model->setModi_fecha(date('Y-m-d H:i:s',$timestamp)); 

        $id_mod = 7; //quitar esta linea y poner la de abajo cuando el loguin vaya
        //$id_mod =Yii::$app->user->id;

        $model->setModi_usuario_id($id_mod); 

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Convocatoria model.
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
     * Reporta una convocatoria
     * 
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionReportar($id)
    {
        

        $model = $this->findModel($id);
   
        // $id not found in database 
        //vamos a poner aquí tambien la comprobación de la sesión en caso de que quiera reportar por URL ;)
        if($model === null || (isset($_SESSION['REPORT_VECES']) && $_SESSION['REPORT_VECES']!=0))   
            throw new NotFoundHttpException('The requested page does not exist.');
            
        $model->report();
           
        $model->update();   

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Función encargada de escribir en la tabla de inscripciones al usuario y a la convocatoria deseada
     */
    public function actionInscribir($id)
    {
        //Cojemos el ID del yii. Como el loguin no va aun esto es teorico
        $id_asistente = 7; //quitar esta linea y poner la de abajo cuando el loguin vaya
        //$id_asistente =Yii::$app->user->id;

        //Busqueda para evitar abusones (Si es esta suscrito)
        $asistente= Asistente::findOne(['convocatoria_id' => $id ,'usuario_id' => $id_asistente ]);

        if(empty($asistente)){

            //creamos un modelo de tipo Asistente con el $id
            $inscripcion = new Asistente();
            //Buscamos el modelo de convocatoria anterrior
            $model = $this->findModel($id);

            //Creo que esto no es necesario
            //$inscripcion->loadDefaultValues();

            $inscripcion->setConvocatoria_id($model->getId());
            $inscripcion->setLocal_id($model->getLocal_Id());
            $inscripcion->setUsuario_id($id_asistente);

            $timestamp = time()-(60*60*4);
            $inscripcion->setFecha_alta(date('Y-m-d H:i:s',$timestamp));        

            $inscripcion->save();
        }

        return $this->redirect(['index']);
    }
    public function actionDesinscribir($id)
    {
        //Cojemos el ID del yii. Como el loguin no va aun esto es teorico
        $id_asistente = 7; //quitar esta linea y poner la de abajo cuando el loguin vaya
        //$id_asistente =Yii::$app->user->id;

        $model = $this->findModel($id);

        //Buscar en la tabla de Asistentes el registro que tiene los id del usuario y la convocatoria
        $asistente= Asistente::findOne(['convocatoria_id' => $id ,'usuario_id' => $id_asistente ]);

        $asistente->delete();
    

        return $this->redirect(['index']);
    }

    /**
     * Finds the Convocatoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Convocatoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Convocatoria::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*********************************************************** 
     * ESTO ES PARA PODER VER LOS ASISTENTES EN UNA CONVOCATORIA
    *************************************************************/
    public function ver_asistentes($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
}
