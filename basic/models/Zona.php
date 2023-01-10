<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zonas".
 *
 * @property int $id
 * @property string $clase_zona_id Código de clase de la zona: 1=Continente, 2=Pais, 3=Estado, 4=Region, 5=Provincia, 6=Municipio, 7=Localidad, 8=Barrio, 9=Area, ...
 * @property string $nombre Nombre de la zona que la identifica.
 * @property int|null $zona_id Zona relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.
 */
class Zona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zonas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clase_zona_id', 'nombre'], 'required'],
            [['zona_id'], 'integer'],
            [['clase_zona_id'], 'string', 'max' => 1],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'clase_zona_id' => Yii::t('app', 'Clase Zona ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'zona_id' => Yii::t('app', 'Zona ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ZonaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZonaQuery(get_called_class());
    }

	public static function listaZonas(){
		$tipos=Zona::find()->orderBy('clase_zona_id')->all();
		return $tipos;
	}
}
