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

	/*
	 * Función para obtener el valor de una variable indicada de la configuración
	 * Debe tener el mismo nombre en la base de datos y en params.php si se define
	 * Por defecto es 10
	 * */
	public static function getValorConfiguracion($variable){
		$num=10;
		if($config=Configuracion::findOne(['variable'=>$variable])){
			if(isset($config->valor) && $config->valor != ''){
				$num=$config->valor;
			}else{
				if(isset(Yii::$app->params[$variable]))
					$num=Yii::$app->params[$variable];
			}
		}else{
			if(isset(Yii::$app->params[$variable]))
				$num=Yii::$app->params[$variable];
		}
		return $num;
	}
}
