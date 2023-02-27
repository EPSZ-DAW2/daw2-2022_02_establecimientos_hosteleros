<?php

namespace app\models;

use app\models\Local;
use Yii;

/**
 * This is the model class for table "locales_etiquetas".
 *
 * @property int $id
 * @property int $local_id establecimiento/local relacionada
 * @property int $etiqueta_id Etiqueta relacionada.
 */
class LocalesEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    { 
        return 'locales_etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['local_id', 'etiqueta_id'], 'required'],
            [['local_id', 'etiqueta_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'id' => Yii::t('app', 'ID'),
            'local_id' => Yii::t('app', 'Local'),
            'etiqueta_id' => Yii::t('app', 'Etiqueta'),
        ];
    }
/* 
    public function relations()
    {
        return [
            'local' => [
                'class' => Local::class,
                'foreignKey' => 'local_id',
                'on' => 'Local.id = LocalesEtiquetas.local_id',
            ],
        ];
    }
 */

    /**
     * {@inheritdoc}
     * @return LocalesEtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalesEtiquetasQuery(get_called_class());
    }


    /* public function getLocales(){
        return $this->hasMany(Local::class,[
            //campos clave de convocatorias y  local
            'local_id' => 'id',
        ])->inverseOf('Local');
    } */


    public function getLocalesEtiquetas(){
        return $this->hasMany(Local::class,[
            //campos clave de convocatorias y  local
            'id' => 'local_id',
        ])->inverseOf('LocalesEtiquetas');
    }

    public static function listaEtiquetas(){
        $tipos=LocalesEtiquetas::find()->orderBy('nombre')->all();
		$lista=ArrayHelper::map($tipos, 'id', 'nombre');
        return $lista;
    }


    // $userQuery = (new Query)->select('id')->from('user');
    //     $query->where(['id' => $userQuery]); 
    //     que generará el siguiente código SQL:
    //     WHERE `id` IN (SELECT `id` FROM `user`)

    /* public static function listaEtiquetas(){
        $queryAUX = (new Query)->select()
    } */
}
