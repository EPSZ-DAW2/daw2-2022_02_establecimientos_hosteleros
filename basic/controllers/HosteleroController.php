<?php

namespace app\controllers;

use app\models\Hostelero;
use app\models\HostelerosSearch;
use Yii;
use yii\data\Pagination;

class HosteleroController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$searchModel = new HostelerosSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);
		$pagination = new Pagination([
			'defaultPageSize' => Yii::$app->params['paginacionHosteleros'],
			'totalCount' => $dataProvider->query->count(),
		]);

		$hosteleros=$dataProvider->query->offset($pagination->offset)
			->limit($pagination->limit)->all();

		return $this->render('listado_hosteleros', [
			'searchModel' => $searchModel,
			'pagination' => $pagination,
			'hosteleros' => $hosteleros,
		]);
	}
	public function actionDetalle()
	{
		//TODO
	}


}
