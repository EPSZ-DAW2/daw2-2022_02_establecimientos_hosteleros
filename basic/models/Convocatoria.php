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


    //SETS
    /**
     * Función que se encarga de modificar el numero de denuncias
     * 
     */
    public function setnum_denuncias($num){
        
        //Si se quiere setear a 0, se tiene que borrar la fecha del primer reporte

        if($num==0){
            $this->setfecha_denuncia1(null);
        }
        
        $this->num_denuncias = $num;

    }
    /**
     * Función que se encarga de modificar la fecha de la denuncia
     * 
     */
    public function setfecha_denuncia1($fecha){
        
        $this->fecha_denuncia1 = $fecha;

    }

    //GETS
    public function getfecha_denuncia1(){
        
        return $this->fecha_denuncia1;

    }
    public function getId(){
        
        return $this->id;

    }
    public function getLocal_id(){
        
        return $this->local_id;

    }
    public function getnum_denuncias(){
        
        return $this->num_denuncias;

    }

    /**
     * Función que comprueba 1 asistente en la convocatoria
     */

     public function getAsistentes(){

        return $this->hasMany(Asistente::class,[
            //campos clave de Asistentes y  valores en convocatorias
            'id' => 'convocatoria_id',
        ])->inverseOf('Convocatoria');

     }



    /**
     *  Función que "reporta" una convocatoria     * 
     * 
     */
    public function report(){
        //echo"\n El numero de denuncias iniciar es: ".$this->getnum_denuncias()."</br>" ;

        if(($this->getnum_denuncias())==0){
            //Se guarda la fecha en la que se realiza la denuncia
            $timestamp = time()-(60*60*4);
            

            //echo"\n Fecha sin formateo: </br>" ;
            //print_r($fecha_no_fort);

            $this->setfecha_denuncia1(date('Y-m-d H:i:s',$timestamp));

            //echo"\n Fecha con formateo: </br>" ;
            print_r(date('Y-M-D H:I:S',$timestamp));
        }
        //Seteamos el valor de las denuncias al que tenía + 1
        $this->setnum_denuncias($this->getnum_denuncias() + 1);
        
        $_SESSION['REPORT_VECES'] = 1;
        //print_r( $this->getfecha_denuncia1());
        //print_r($this->getnum_denuncias());

        //$this->save();

    }
    /**
     *  Función que crea un registro en Asistente
     * 
     */
    public function inscribir(){
        
        

    }

        /**
     *  Función que borra un registro en Asistente
     * 
     */
    public function desinscribir(){
        
        

    }


    

         
}
