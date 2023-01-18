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
            'localNombre' => Yii::t('app', 'Local'),
            'convocatoria_id' => Yii::t('app', 'Convocatoria ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'usuarioNombre' => Yii::t('app', 'Nombre'),
            'usuarioApellidos' => Yii::t('app', 'Apellidos'),
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
    /**
     * Función que comprueba 1 asistente en la convocatoria
     */

     public function getConvocatoria(){

        return $this->hasOne(Convocatoria::class,[
            //campos clave de Asistentes y  valores en convocatorias
            'id' => 'convocatoria_id',
        ])->inverseOf('Asistente');

     }

    //GETS

    public function getid(){
        
        return $this->id;

    }
    public function getLocal_id(){
        
        return $this->local_id;

    }
    public function getConvocatoria_id(){
        
        return $this->Convocatoria_id;

    }
    public function getUsuario_id(){
        
        return $this->Usuario_id;

    }
    public function getFecha_alta(){
        
        return $this->fecha_alta;

    }

    //SETS
    /*El Id normal al ser la clave de la tabla no se debería poder cambiar asi que directamente no pongo la opción */
    public function setLocal_id($Id){
        
        $this->local_id = $Id;

    }
    public function setConvocatoria_id($Id){
        
        $this->convocatoria_id = $Id;

    }
    public function setUsuario_id($Id){
        
        $this->usuario_id = $Id ;

    }
    public function setFecha_alta($Fecha){
        
        $this->fecha_alta = $Fecha;

    }
    protected $localNombre = null;
    protected $usuarioNombre = null;
    protected $usuarioApellidos = null;
    public function getLocalNombre(){
        //buscador de locales
        $Local = Local::find()->where(['id' => $this->getLocal_id()])->one();
        if($Local != null || $Local != "")
            return $Local->titulo;
        return 'Error al cargar el nombre';
    }
    public function getUsuarioNombre(){
        //buscador de locales
        $Usuario = Usuario::find()->where(['id' => $this->getUsuario_id()])->one();
        if($Usuario != null || $Usuario != "")
            return $Usuario->nombre;
        return 'Error al cargar el nombre';
    }
    public function getUsuarioApellidos(){
        //buscador de locales
        $Usuario = Usuario::find()->where(['id' => $this->getUsuario_id()])->one();
        if($Usuario != null || $Usuario != "")
            return $Usuario->apellidos;
        return 'Error al cargar el apellido';
    }
}
