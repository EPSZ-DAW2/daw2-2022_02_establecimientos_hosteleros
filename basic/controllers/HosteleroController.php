<?php

namespace app\controllers;

use app\models\Configuracion;
use app\models\Hostelero;
use app\models\HostelerosSearch;
use Yii;
use yii\data\Pagination;

class HosteleroController extends \yii\web\Controller
{
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
