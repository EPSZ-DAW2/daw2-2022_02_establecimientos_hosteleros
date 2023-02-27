<?php

namespace app\controllers;
use app\models\Asistente;
use app\models\AsistenteSearch;
use app\models\Convocatoria;
use app\models\ConvocatoriaSearch;
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
 * ConvocatoriaController implements the CRUD actions for Convocatoria model.
 */
class ConvocatoriaController extends Controller
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
     * Lists all Convocatoria models.
     *
     * @return string
     */
    public function actionIndex()
    {
        //Buscamos todas las convocatorias
        $searchModel = new ConvocatoriaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        //creamos el paginador
        $pagination = new Pagination([
			'defaultPageSize' => Configuracion::getValorConfiguracion('numero_paginacion_hosteleros'),
			'totalCount' => $dataProvider->query->count(),
		]);
        //sacamos los datos según elpaginador
        $convocatorias=$dataProvider->query->offset($pagination->offset)
			->limit($pagination->limit)->all();
        
         
        
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            return $this->render('index_admin', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('index_publica', [
                'searchModel' => $searchModel,
                'pagination' => $pagination,
                'convocatorias' => $convocatorias,
            ]);
        }
            
        
    }
    public function actionVerpropias()
    {
        //Buscamos todas las convocatorias
        $searchModel = new ConvocatoriaSearch();
        //find(Yii::$app->user->id)
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->where(['locales_convocatorias.crea_usuario_id' => Yii::$app->user->id]);
        
        //creamos el paginador
        $pagination = new Pagination([
			'defaultPageSize' => Configuracion::getValorConfiguracion('numero_paginacion_hosteleros'),
			'totalCount' => $dataProvider->query->count(),
		]);
        //sacamos los datos según elpaginador
        $convocatorias=$dataProvider->query->offset($pagination->offset)
			->limit($pagination->limit)->all();

        if(!Yii::$app->user->isGuest){
            return $this->render('index_admin', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Convocatoria model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        return $this->render('view_admin', [
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
        $id=Yii::$app->user->id;
        // Para crear convocatoria solo interesa que este logueado por ahora        
        
        if($id != Null){
            $model = new Convocatoria();

            if ($this->request->isPost) {
                $post = $this->request->post();
                if ($model->load($post) && $model->CrearFechas() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            //Añadir un mensaje de información de que no se tiene permisos para estar ahí
            return $this->redirect(['index']);
        }
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
        //$id_mod =Yii::$app->user->id;
        $model = $this->findModel($id);
        // Habría que añadir la comprobación de que tiene permisos 
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id) || $model->crea_usuario_id == Yii::$app->user->id)){
            //$model = $this->findModel($id);

            $timestamp = time()-(60*60*4);
            $model->modi_fecha = date('Y-m-d H:i:s',$timestamp); 

            //$id_mod = 7; //quitar esta linea y poner la de abajo cuando el loguin vaya
            //$id_mod =Yii::$app->user->id;

            $model->modi_usuario_id =Yii::$app->user->id; 

            if ($this->request->isPost && $model->load($this->request->post()) && $model->CrearFechas() && $model->save()) {
                
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else { //Que devuelva a index
            //Añadir un mensaje de información de que no se tiene permisos para estar ahí
            return $this->redirect(['index']);
        }
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
        $id_mod =Yii::$app->user->id;
        // Habría que añadir la comprobación de que tiene permisos 
        if($id_mod != Null){

            $this->findModel($id)->delete();

        } else {
            //mensaje de no se tiene permisos
        }

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
        $id_mod =Yii::$app->user->id; 

        //En este caso solo nos interesa de que esté logueado
        if($id_mod != Null){
            $model = $this->findModel($id);
    
            // $id not found in database 
            //vamos a poner aquí tambien la comprobación de la sesión en caso de que quiera reportar por URL ;)
            if($model === null || (isset($_SESSION['REPORT_VECES']) && $_SESSION['REPORT_VECES']!=0))   
                throw new NotFoundHttpException('The requested page does not exist.');
                
            $model->report();
            
            $model->update();   
        }

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Función encargada de escribir en la tabla de inscripciones al usuario y a la convocatoria deseada
     */
    public function actionInscribir($id)
    {
        //Cojemos el ID del yii. Como el loguin no va aun esto es teorico
        //$id_asistente = 7; //quitar esta linea y poner la de abajo cuando el loguin vaya
        $id_asistente =Yii::$app->user->id;

        //En este caso solo nos interesa de que esté logueado
        if($id_asistente != Null){
            //Busqueda para evitar abusones (Si es esta suscrito)
            $asistente= Asistente::findOne(['convocatoria_id' => $id ,'usuario_id' => $id_asistente ]);

            if(empty($asistente)){ //Si no está suscrito

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
        }
        return $this->redirect(['index']);
    }
    public function actionDesinscribir($id)
    {
        //Cojemos el ID del yii. Como el loguin no va aun esto es teorico
        //$id_asistente = 7; //quitar esta linea y poner la de abajo cuando el loguin vaya
        $id_asistente =Yii::$app->user->id;

        //En este caso solo nos interesa de que esté logueado
        if($id_asistente != Null){

            $model = $this->findModel($id);

            //Buscar en la tabla de Asistentes el registro que tiene los id del usuario y la convocatoria
            $asistente= Asistente::findOne(['convocatoria_id' => $id ,'usuario_id' => $id_asistente ]);

            if(!empty($asistente)){ //Si encuentra un registro de que si está suscrito
                $asistente->delete();
            } //Si no, no hace nada
        }

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
    public function actionVer($id,$id_local)
       
    {     
        //Si el usuario está logueado
        $id_asistente =Yii::$app->user->id;
        if($id_asistente != Null){
            //si tiene permisos Aun no implementado por loque no puedo hacer nada
            $permisos = new UsuarioRol;


          
       // $Convocatoria = Convocatoria::findOne($id);
       // $asistente = $Convocatoria->asistentes;
    
        
            $searchModel = new AsistenteSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->query->where(['convocatoria_id' =>$id]);

            $asistente=$dataProvider;
         // $Convocatoria = Convocatoria::findOne($id);
         // $asistente = $Convocatoria->asistentes;
           $model= $asistente;
            return $this->render('../asistentes/ver_asistentes', ['model' => $model,'searchModel' => $searchModel,'dataProvider' => $dataProvider,'convocatoria'=>$id,'local'=>$id_local]);
        }

    }
}
