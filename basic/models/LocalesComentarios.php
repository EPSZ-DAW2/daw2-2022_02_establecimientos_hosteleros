<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locales_comentarios".
 *
 * @property int $id
 * @property int $local_id establecimiento/local relacionado
 * @property int $valoracion Valoración dada al establecimiento/local.
 * @property string $texto El texto del comentario.
 * @property int|null $comentario_id Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.
 * @property int $cerrado Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)
 * @property int $num_denuncias Contador de denuncias del comentario o CERO si no ha tenido.
 * @property string|null $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property int $bloqueado Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 * @property int|null $crea_usuario_id Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.
 */
class LocalesComentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locales_comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['local_id', 'texto'], 'required'],
            [['local_id', 'valoracion', 'comentario_id', 'cerrado', 'num_denuncias', 'bloqueado', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'notas_bloqueo'], 'string'],
            [['fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'local_id' => Yii::t('app', 'establecimiento/local relacionado'),
            'valoracion' => Yii::t('app', 'Valoración dada al establecimiento/local.'),
            'texto' => Yii::t('app', 'El texto del comentario.'),
            'comentario_id' => Yii::t('app', 'Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.'),
            'cerrado' => Yii::t('app', 'Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)'),
            'num_denuncias' => Yii::t('app', 'Contador de denuncias del comentario o CERO si no ha tenido.'),
            'fecha_denuncia1' => Yii::t('app', 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.'),
            'bloqueado' => Yii::t('app', 'Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.'),
            'notas_bloqueo' => Yii::t('app', 'Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.'),
            'crea_usuario_id' => Yii::t('app', 'Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.'),
            'crea_fecha' => Yii::t('app', 'Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.'),
            'modi_usuario_id' => Yii::t('app', 'Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.'),
            'modi_fecha' => Yii::t('app', 'Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LocalesComentariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalesComentariosQuery(get_called_class());
    }
    public static function listarcomentarios($id){
        return Yii::$app->db->createCommand('SELECT valoracion,texto,crea_fecha FROM '.LocalesComentarios::tableName().' WHERE id='.$id.' ORDER BY crea_fecha')->queryAll();
    }

}
