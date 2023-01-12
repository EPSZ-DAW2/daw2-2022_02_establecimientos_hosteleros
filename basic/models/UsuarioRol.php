<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_rol".
 *
 * @property int $id_usuario
 * @property int $id_rol
 */
class UsuarioRol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_rol'], 'required'],
            [['id_usuario', 'id_rol'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'id_rol' => Yii::t('app', 'Id Rol'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuarioRolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioRolQuery(get_called_class());
    }
}
