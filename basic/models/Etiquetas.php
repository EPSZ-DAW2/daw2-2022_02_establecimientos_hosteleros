<?php

namespace app\models;


use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "etiquetas".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion Texto adicional que describe la etiqueta o NULL si no es necesario.
 * @property int $revisada Indicador de etiqueta aceptada o no por los moderadores/administradores: 0=No, 1=Si.
 */
class Etiquetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['revisada'], 'integer'],
            [['nombre'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'revisada' => 'Revisada',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EtiquetasQuery(get_called_class());
    }

    public function getLocalesEtiquetas(){
        return $this->hasMany(LocalesEtiquetas::class,[
            //campos clave de convocatorias y  local
            'id' => 'local_id',
        ])->inverseOf('localesetiquetas');
    }

    public function getNombre(){
        if($this->nombre==NULL){
            return "";
        } else {
            return $this->nombre;
        }
    }

    public function getId(){
        if($this->id==NULL){
            return "";
        } else {
            return $this->id;
        }
    }

    public static function listaEtiquetas(){
        $tipos=self::find()->orderBy('nombre')->all();
		$lista=ArrayHelper::map($tipos, 'id', 'nombre');
        return $lista;
    }
}
