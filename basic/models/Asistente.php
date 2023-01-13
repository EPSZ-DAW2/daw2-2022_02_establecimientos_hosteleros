<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locales_convocatorias_asistentes".
 *
 * @property int $id
 * @property int $local_id establecimiento/local relacionado
 * @property int $convocatoria_id convocatoria relacionada
 * @property int|null $usuario_id usuario relacionado que asistira a la convocatoria.
 * @property string|null $fecha_alta Fecha y Hora de creación de la asistencia a la convocatoria o NULL si no se conoce por algún motivo.
 */
class Asistente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locales_convocatorias_asistentes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['local_id', 'convocatoria_id'], 'required'],
            [['local_id', 'convocatoria_id', 'usuario_id'], 'integer'],
            [['fecha_alta'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'local_id' => Yii::t('app', 'Local ID'),
            'convocatoria_id' => Yii::t('app', 'Convocatoria ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'fecha_alta' => Yii::t('app', 'Fecha Alta'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AsistentesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsistentesQuery(get_called_class());
    }
}
