<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuraciones".
 *
 * @property string $variable
 * @property string|null $valor
 */
class Configuracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configuraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['variable'], 'required'],
            [['valor'], 'string'],
            [['variable'], 'string', 'max' => 50],
            [['variable'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'variable' => Yii::t('app', 'Variable'),
            'valor' => Yii::t('app', 'Valor'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ConfiguracionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfiguracionQuery(get_called_class());
    }

	//Se obtiene las veces de intento de la configuración si existen.
	//Si no se usan los valores definidos en params.php
	public static function getNumIntentosUsuario(){
		$numVeces=10;
		if($configNumVeces=Configuracion::findOne(['variable'=>'numero_intentos_usuario'])){
			if(isset($configNumVeces->valor) && $configNumVeces->valor != ''){
				$numVeces=$configNumVeces->valor;
			}else{
				if(isset(Yii::$app->params['numero_intentos_usuario']))
					$numVeces=Yii::$app->params['numero_intentos_usuario'];
			}
		}else{
			if(isset(Yii::$app->params['numero_intentos_usuario']))
				$numVeces=Yii::$app->params['numero_intentos_usuario'];
		}
		return $numVeces;
	}

	//Se obtienen los minutos de la configuración si existen.
	//Si no se usan los valores definidos en params.php
	public static function getTiempoDesbloqueoUsuario(){
		$tiempo=5;
		if($configTiempo=Configuracion::findOne(['variable'=>'tiempo_desbloqueo_usuario'])){
			if(isset($configTiempo->valor) && $configTiempo->valor != ''){
				$tiempo=$configTiempo->valor;
			}else{
				if(isset(Yii::$app->params['tiempo_desbloqueo_usuario']))
					$tiempo=Yii::$app->params['tiempo_desbloqueo_usuario'];
			}
		}else{
			if(isset(Yii::$app->params['tiempo_desbloqueo_usuario']))
				$tiempo=Yii::$app->params['tiempo_desbloqueo_usuario'];
		}
		return $tiempo;
	}
}
