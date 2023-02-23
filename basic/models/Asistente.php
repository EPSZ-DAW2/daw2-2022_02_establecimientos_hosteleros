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
            [['fecha_alta','titulo','usuarioNombre','usuarioApellidos'], 'safe'],
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
            'titulo' =>Yii::t('app', 'Local'),
            'convocatoria_id' => Yii::t('app', 'Convocatoria ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'nombre' => Yii::t('app', 'Nombre  Asistente'),
            'apellidos' => Yii::t('app', 'Apellidos Asistente'),
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
    public static function listar($id)
    {
        $lista=Asistente::find()->Where(['=', 'convocatoria_id', $id]);
        return $lista;
    }
    /**
     * Función que comprueba 1 asistente en la convocatoria
     */

    /* public function getConvocatoria(){

        return $this->hasOne(Convocatoria::class,[
            //campos clave de Asistentes y  valores en convocatorias
            'id' => 'convocatoria_id',
        ])->inverseOf('Asistente');

     }*/

    //GETS

    public function getid(){
        
        return $this->id;

    }
    public function getLocal_id(){
        
        return $this->local_id;

    }
    public function getConvocatoria_id(){
        
        return $this->convocatoria_id;

    }
    public function getUsuario_id(){
        
        return $this->usuario_id;

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
    
    
    public function getUsuario(){
        //buscador de usuarios
       
       return $this->hasOne(Usuario::class, ['id' =>'usuario_id'])->inverseOf('usuario');
    
    }
    protected $nombre = null;
    public function getNombre(){
        //buscador de nombre para poderlo poner en attribute labels w
        if($this->usuario==NULL)
        {
          return "";
        }else{
        return  $this->usuario->nombre;}
    }
    protected $apellidos = null;
    public function getApellidos(){
    
        if($this->usuario==NULL)
        {
          return "";
        }else{
        return  $this->usuario->apellidos;}
       
    }    public function getLocal(){
        return $this->hasOne(Local::class, ['id' =>'local_id'])->inverseOf('local');
    }
    public function getTitulo(){
        //buscador de locales
           if($this->local==NULL)
           {
             return "";
           }else{
               
            return $this->local->titulo;
        
           }
    }
    
    protected $lo = null;
    
        public function getConvocatoria(){
            //buscador de locales
           
           return $this->hasOne(Convocatoria::class, ['id' =>'convocatoria_id'])->inverseOf('Convocatoria');
        
        }
        protected $Convocatoria = null;
    
}
