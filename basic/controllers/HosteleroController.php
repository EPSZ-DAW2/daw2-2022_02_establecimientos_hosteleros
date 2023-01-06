<?php

namespace app\controllers;

use app\models\Hostelero;

class HosteleroController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$hosteleros=Hostelero::find()->all();

		return $this->render('index', [
			'hosteleros'=>$hosteleros
		]);
	}
	public function actionDetalle()
	{
		//TODO
	}


}
