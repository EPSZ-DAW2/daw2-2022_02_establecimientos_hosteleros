<?php

namespace app\models;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "zonas".
 *
 * @property int $id
 * @property string $clase_zona_id Código de clase de la zona: 1=Continente, 2=Pais, 3=Estado, 4=Region, 5=Provincia, 6=Municipio, 7=Localidad, 8=Barrio, 9=Area, ...
 * @property string $nombre Nombre de la zona que la identifica.
 * @property int|null $zona_id Zona relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.
 */
class Zonas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zonas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clase_zona_id', 'nombre'], 'required'],
            [['zona_id'], 'integer'],
            [['clase_zona_id'], 'string', 'max' => 1],
            [['nombre','tipo_zona','padre_Nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_zona' => Yii::t('app', 'Tipo de Zona'),
            'clase_zona_id' => Yii::t('app', 'Id de Clase Zona'),
            'nombre' => Yii::t('app', 'Nombre'),
            'zona_id' => Yii::t('app', 'Zona ID'),
            'padre_Nombre' => Yii::t('app', 'Nombre del Padre'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ZonasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZonasQuery(get_called_class());
    }


    public static function listaZonas(){
        return [
            '1' => 'Continente',
            '2' => 'Pais',
            '3' => 'Estado',
            '4' => 'Región',
            '5' => 'Provincia',
            '6' => 'Municipìo',
            '7' => 'Localidad',
            '8' => 'Barrio',
            '9' => 'Area',
        ];
    }
    /*public static function listaZonas_ID(){
        return [
            'Continente' => '1',
            'Pais' => '2',
            'Estado' => '3',
            'Región' => '4',
            'Provincia' => '5',
            'Municipìo' => '6',
            'Localidad' => '7',
            'Barrio' => '8',
            'Area' => '9' ,
        ];
    }*/

    public static function getTipoZona($zona_Id)
    {
        $lista= static::listaZonas();

        $res= (isset($lista[$zona_Id]) ? $lista[$zona_Id] : 'No definido');
        return $res;
    }
    /**
     * Función que devuelve la zona padre de una zona
     * 
     */
    public function getPadre(){
        
        return $this->hasOne(Zonas::className(),[
            //campos clave de zonas y  valor que tiene en el hijo
            'id' => 'zona_id',
        ])->from(['padre' => Zonas::tableName()]);

    }
    /**
     * Función que devuelve los hijos de una zona
     */
    public function getHijos(){
        
        return $this->hasMany(Zonas::class,[
            //campos clave de zonas y  valor que tiene en el hijo
            'zona_id' => 'id',
        ])->from(['hijos' => Zonas::tableName()]);

    }

    public function ComprobarDatos(){
        //Comrpobar el id de la Clase zona [0-9]
        //Coger id del padre y buscarlo. 
        $padre=$this->padre;
        if( $padre != null){ //Si tiene padre
            
            //Ver el tipo del padre            
            //Comparar Tipo Padre > Tipo Hijo
            if($padre->clase_zona_id < $this->clase_zona_id){ // El tipo de zona del padre debe ser menor en jerarquía
                
                return true;
            } else { // el padre no puede ser un tipo de zona mas pequeño
                
                return false;
            }
            
        } else {
            if ($this->clase_zona_id == 1) return true; //Si es un continente
            return false; 
        }
        

    }
    protected $tipo_zona  = null;

    public function getTipo_zona(){
        
        return $this->listaZonas()[$this->clase_zona_id];
    }

    protected $padre_Nombre = null;

    public function getPadre_Nombre(){

        if ($this->padre == null)
            return "";
        
        return $this->padre->nombre;
    }
 

    


    

}