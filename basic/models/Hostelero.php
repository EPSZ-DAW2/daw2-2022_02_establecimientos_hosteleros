<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hosteleros".
 *
 * @property int $id
 * @property int $usuario_id Usuario relacionado con los datos principales.
 * @property string $nif_cif Identificador del hostelero.
 * @property string|null $razon_social Razon social del comercio o NULL si con el "nombre y apellidos" del usuario es suficiente.
 * @property string $telefono_comercio
 * @property string $telefono_contacto
 * @property string|null $url Dirección web del comercio o NULL si no hay o no se conoce.
 * @property string|null $fecha_alta Fecha y Hora de alta como hostelero, no como usuario o NULL si no se conoce por algún motivo (que no debería ser).
 */
class Hostelero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hosteleros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'nif_cif', 'telefono_comercio', 'telefono_contacto'], 'required'],
            [['usuario_id'], 'integer'],
            [['url'], 'string'],
            [['fecha_alta'], 'safe'],
            [['nif_cif'], 'string', 'max' => 12],
            [['razon_social'], 'string', 'max' => 255],
            [['telefono_comercio', 'telefono_contacto'], 'string', 'max' => 25],
            [['nif_cif'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'nif_cif' => Yii::t('app', 'Nif Cif'),
            'razon_social' => Yii::t('app', 'Razon Social'),
            'telefono_comercio' => Yii::t('app', 'Telefono Comercio'),
            'telefono_contacto' => Yii::t('app', 'Telefono Contacto'),
            'url' => Yii::t('app', 'Url'),
            'fecha_alta' => Yii::t('app', 'Fecha Alta'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return HosteleroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HosteleroQuery(get_called_class());
    }

	//Se obtiene el usuario asociado al hostelero
	public function getUsuario(){
		return $this->hasOne(Usuario::class, [
			'id'=>'usuario_id',
		]);
	}
}
