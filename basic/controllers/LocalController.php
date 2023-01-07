<?php

namespace app\controllers;

use app\models\Local;

class LocalController extends \yii\web\Controller
{
    public function actionIndex($id=null)
    {
		$locales=Local::find()->where(['visible'=>1]);

		if(isset($id) && $id!=null)
			$locales->andWhere(['hostelero_id'=>$id]);

		return $this->render('index', [
			'locales'=>$locales->all(),
		]);
    }

	public function actionDetalle()
	{
		//TODO
	}
}
