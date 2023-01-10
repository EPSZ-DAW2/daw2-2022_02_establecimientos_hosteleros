<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_area_moderacion".
 *
 * @property int $id
 * @property int $usuario_id Usuario relacionado con un Area para su moderación.
 * @property int $zona_id Zona relacionada con el Usuario que puede moderarla.
 */
class UsuarioAreaModeracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_area_moderacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'zona_id'], 'required'],
            [['usuario_id', 'zona_id'], 'integer'],
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
            'zona_id' => Yii::t('app', 'Zona ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuarioAreaModeracionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioAreaModeracionQuery(get_called_class());
    }
}
