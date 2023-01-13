<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locales_convocatorias".
 *
 * @property int $id
 * @property int $local_id establecimiento/local relacionado
 * @property string $texto El texto de la convocatoria.
 * @property string|null $fecha_desde Fecha y Hora de inicio de la convocatoria o NULL si no se conoce (mostrar próximamente).
 * @property string|null $fecha_hasta Fecha y Hora de finalización de la convocatoria o NULL si no se conoce (no caduca automáticamente).
 * @property int $num_denuncias Contador de denuncias de la convocatoria o CERO si no ha tenido.
 * @property string|null $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property int $bloqueada Indicador de convocatoria bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo de la convocatoria. Debería estar a NULL si no está bloqueada o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo de la convocatoria o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 * @property int|null $crea_usuario_id Usuario que ha creado la convocatoria o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación de la convocatoria o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado la convocatoria por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación de la convocatoria o NULL si no se conoce por algún motivo.
 */
class Convocatoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locales_convocatorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['local_id', 'texto'], 'required'],
            [['local_id', 'num_denuncias', 'bloqueada', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'notas_bloqueo'], 'string'],
            [['fecha_desde', 'fecha_hasta', 'fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
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
            'texto' => Yii::t('app', 'Texto'),
            'fecha_desde' => Yii::t('app', 'Fecha Desde'),
            'fecha_hasta' => Yii::t('app', 'Fecha Hasta'),
            'num_denuncias' => Yii::t('app', 'Num Denuncias'),
            'fecha_denuncia1' => Yii::t('app', 'Fecha Denuncia1'),
            'bloqueada' => Yii::t('app', 'Bloqueada'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha Bloqueo'),
            'notas_bloqueo' => Yii::t('app', 'Notas Bloqueo'),
            'crea_usuario_id' => Yii::t('app', 'Crea Usuario ID'),
            'crea_fecha' => Yii::t('app', 'Crea Fecha'),
            'modi_usuario_id' => Yii::t('app', 'Modi Usuario ID'),
            'modi_fecha' => Yii::t('app', 'Modi Fecha'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ConvocatoriaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConvocatoriaQuery(get_called_class());
    }
}
