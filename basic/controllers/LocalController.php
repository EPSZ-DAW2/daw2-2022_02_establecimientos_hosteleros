<?php

namespace app\controllers;

use app\models\Local;

class LocalController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$locales=Local::find()
			->where(['visible'=>1])
			->all();

		return $this->render('index', [
			'locales'=>$locales
		]);
    }
}
