<?php

namespace app\controllers;

use app\models\Configuracion;
use app\models\Hostelero;
use app\models\HostelerosSearch;
use app\models\Usuario;
use app\models\UsuarioAviso;
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

	//Acción que muestra los hosteleros de manera paginada teniendo en cuenta los filtros aplicados
	public function actionIndex()
	{
		//Se define el modelo de buscador y los datos teniendo en cuenta los filtros
		$searchModel = new HostelerosSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);
		//Paginación obteniendo el tamaño de página de la configuración
		$pagination = new Pagination([
			'defaultPageSize' => Configuracion::getValorConfiguracion('numero_paginacion_hosteleros'),
			'totalCount' => $dataProvider->query->count(),
		]);

		//Se obtienen los hosteleros teniendo en cuenta la paginación
		$hosteleros=$dataProvider->query->offset($pagination->offset)
			->limit($pagination->limit)->all();

		//Se carga la página indicada con los parámetros
		return $this->render('listado_hosteleros', [
			'searchModel' => $searchModel,
			'pagination' => $pagination,
			'hosteleros' => $hosteleros,
		]);
	}

	//Acción para mandar un mensaje/aviso al usuario hostelero
	public function actionMensaje($id=null)
	{
		//Si el usuario no está logeado no puede enviar avisos
		if(Yii::$app->user->isGuest)
			return $this->actionIndex();

		//Si no coinciden los ids se manda el aviso
		if(Yii::$app->user->id != $id){
			//Generación del aviso
			$aviso= new UsuarioAviso();
			$aviso->fecha_aviso=date("Y-m-d H:i:s");
			$aviso->clase_aviso_id='M';
			$aviso->texto='El usuario con nick "'.Yii::$app->user->identity->nick.'" quiere contactar contigo';
			$aviso->destino_usuario_id=$id;
			$aviso->origen_usuario_id=Yii::$app->user->id;

			//Se valida y guarda
			if($aviso->validate() && $aviso->save())
				return $this->actionIndex();
			else{
				Yii::error('Envío de aviso de mensaje a hostelero fallido');
				return $this->actionIndex();
			}

		}else
			return $this->actionIndex();

	}


}
