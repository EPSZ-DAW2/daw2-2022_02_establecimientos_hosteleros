<?php

namespace app\controllers;

use app\models\Local;
use app\models\LocalSearch;
use app\models\Usuario;
use Yii;

class LocalController extends \yii\web\Controller
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

	//Acción inicial de la web, muestra un listado de locales
    public function actionIndex($id=null,$zona=null,$prioridad=null)
    {
		$locales=Local::find()->where(['visible'=>1]);
		$searchModel = new LocalSearch();

		$dataProvider = $searchModel->search($this->request->queryParams);
        //$zona= (isset($_GET['zona']) ? $_GET['zona'] : NULL);
        //$zona = Yii::$app->request->get('zona');

      

        //Cuando las zonas sean funcionales descomentar las siguientes lineas y comentar la linea marcada
        //Al descomentar la siguiente linea añadir a esa variable la zona filtro
        $filtro_zona=$zona;
        if($filtro_zona!=null){
			if($prioridad!=null){
				$localespat=Local::find()->where(['visible'=>1,'zona_id'=>$filtro_zona])->orderBy(['prioridad'=>SORT_DESC])->limit(5);
			}else{
				$localespat=Local::find()->where(['visible'=>1,'zona_id'=>$filtro_zona]);
			}
           
        }else{
			if($prioridad!=null){
				$localespat=Local::find()->where(['visible'=>1])->orderBy(['prioridad'=>SORT_DESC])->limit(5);
						}else{
				$localespat=Local::find()->where(['visible'=>1]);
			}
           
        }


		if(isset($id) && $id!=null)
			//$locales->andWhere(['hostelero_id'=>$id]);
			$locales=$dataProvider->query->all()->andWhere(['hostelero_id'=>$id]);
        if(isset($zona)&& $zona!=null){
            //$locales->andWhere(['zona_id'=>$zona]);
			$locales=$dataProvider->query->all()->andWhere(['zona_id'=>$zona]);
        }
		$locales=$dataProvider->query->all();
		return $this->render('index', [
			'searchModel' => $searchModel,
			//'locales'=>$locales->all(),
			'locales'=>$locales,
			'localespat'=>$localespat->all(),
		]);
    }


}
