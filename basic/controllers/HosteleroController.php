<?php

namespace app\controllers;

use app\models\Configuracion;
use app\models\Hostelero;
use app\models\HostelerosSearch;
use app\models\Usuario;
use Yii;
use yii\data\Pagination;

class HosteleroController extends \yii\web\Controller
{
	/*
	 * Función sobreescrita para comprobar que layout usar
	 * y que homeUrl definir según el rol del usuario
	 * */
	public function beforeAction($action)
	{
		if(!\Yii::$app->user->isGuest){
			if(Usuario::esRolAdmin(\Yii::$app->user->id)){
				$this->layout='privada';
				\Yii::$app->homeUrl=array('usuarios/index');
			}

		}else{
			$this->layout='publica';
			\Yii::$app->homeUrl=array('local/index');
		}

		return parent::beforeAction($action);
	}

	//Acción que muestra los hosteleros de manera paginada teniendo en cuenta los filtros aplicados
	public function actionIndex()
	{
		$searchModel = new HostelerosSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);
		$pagination = new Pagination([
			'defaultPageSize' => Configuracion::getValorConfiguracion('numero_paginacion_hosteleros'),
			'totalCount' => $dataProvider->query->count(),
		]);

		$hosteleros=$dataProvider->query->offset($pagination->offset)
			->limit($pagination->limit)->all();

		//Se carga la página indicada con los parámetros
		return $this->render('listado_hosteleros', [
			'searchModel' => $searchModel,
			'pagination' => $pagination,
			'hosteleros' => $hosteleros,
		]);
	}

	public function actionMensaje()
	{
		//TODO
	}


}
