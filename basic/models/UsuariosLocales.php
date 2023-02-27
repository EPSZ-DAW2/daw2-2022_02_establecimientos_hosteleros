<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_locales".
 *
 * @property int $id
 * @property int $usuario_id Usuario relacionado, seguidor del establecimiento/local.
 * @property int $local_id establecimiento/local relacionado.
 * @property string $fecha_alta Fecha y Hora de activación del seguimiento del establecimiento/local por parte del usuario.
 */
class UsuariosLocales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_locales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'local_id', 'fecha_alta'], 'required'],
            [['usuario_id', 'local_id'], 'integer'],
            [['fecha_alta'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario seguidor'),
            'local_id' => Yii::t('app', 'Local'),
            'fecha_alta' => Yii::t('app', 'Inicio del seguimiento'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuariosLocalesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosLocalesQuery(get_called_class());
    }


    public function comprobarSeguimiento($usuario_id, $local_id){
        $relaciones=$this->find()->where(["usuario_id"=>$usuario_id, "local_id"=>$local_id]);
        
        if($relaciones->count()==1){
            return true;
        } else {
            return false;
        }
    }
}