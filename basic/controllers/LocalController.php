<?php

namespace app\controllers;

use app\models\Local;
use app\models\Usuario;

class LocalController extends \yii\web\Controller
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

	//Acción inicial de la web, muestra un listado de locales
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
