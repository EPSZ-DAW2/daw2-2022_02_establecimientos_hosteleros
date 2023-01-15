<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locales_imagenes".
 *
 * @property int $id
 * @property int $local_id establecimiento/local relacionada
 * @property int $orden Orden de aparición de la imagen dentro del grupo de imagenes de la establecimiento. Opcional.
 * @property string|null $imagen_id Nombre identificativo (fichero interno) con la imagen del establecimiento/local.
 */
class LocalesImagenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locales_imagenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['local_id'], 'required'],
            [['local_id', 'orden'], 'integer'],
            [['imagen_id'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'local_id' => Yii::t('app', 'establecimiento/local relacionada'),
            'orden' => Yii::t('app', 'Orden de aparición de la imagen dentro del grupo de imagenes de la establecimiento. Opcional.'),
            'imagen_id' => Yii::t('app', 'Nombre identificativo (fichero interno) con la imagen del establecimiento/local.'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LocalesImagenesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalesImagenesQuery(get_called_class());
    }
}
