<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $email Correo Electronico y "login" del usuario.
 * @property string $password
 * @property string $nick
 * @property string $nombre
 * @property string $apellidos
 * @property string|null $fecha_nacimiento Fecha de nacimiento del usuario o NULL si no lo quiere informar.
 * @property string|null $direccion Direccion del usuario o NULL si no quiere informar.
 * @property int $zona_id Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.
 * @property string|null $fecha_registro Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).
 * @property int $confirmado Indicador de usuario ha confirmado su registro o no.
 * @property string|null $fecha_acceso Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.
 * @property int $num_accesos Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.
 * @property int $bloqueado Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

	public $authKey;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			['email','required', 'message'=>'Debes indicar tu email'],
			['nombre','required', 'message'=>'Debes indicar tu nombre'],
			['apellidos','required', 'message'=>'Debes indicar tus apellidos'],
			['nick','required', 'message'=>'Debes indicar tu nick'],
			['password','required', 'message'=>'Debes indicar una contraseña'],
			['zona_id','required', 'message'=>'Debes indicar tu zona geográfica'],
            [['email', 'password', 'nick', 'nombre', 'apellidos', 'zona_id', 'confirmado'], 'required'],
            [['fecha_nacimiento', 'fecha_registro', 'fecha_acceso', 'fecha_bloqueo'], 'safe'],
			['nick', 'unique', 'message'=>'Este nick ya ya está en uso. Prueba con otro'],
			['email', 'unique', 'message'=>'Este email ya está en uso. Prueba con otro'],
            [['direccion', 'notas_bloqueo'], 'string'],
            [['zona_id', 'confirmado', 'num_accesos', 'bloqueado'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['nick'], 'string', 'max' => 25],
            [['nombre'], 'string', 'max' => 50],
            [['apellidos'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['nick'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Contraseña'),
            'nick' => Yii::t('app', 'Nick'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'fecha_nacimiento' => Yii::t('app', 'Fecha Nacimiento'),
            'direccion' => Yii::t('app', 'Direccion'),
            'zona_id' => Yii::t('app', 'Zona'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'confirmado' => Yii::t('app', 'Confirmado'),
            'fecha_acceso' => Yii::t('app', 'Fecha Acceso'),
            'num_accesos' => Yii::t('app', 'Num Accesos'),
            'bloqueado' => Yii::t('app', 'Bloqueado'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha Bloqueo'),
            'notas_bloqueo' => Yii::t('app', 'Notas Bloqueo'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioQuery(get_called_class());
    }

	public static function findIdentity($id)
	{
		return self::findOne($id);
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new \yii\base\NotSupportedException("No existe");
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthKey()
	{
		return $this->authKey;
	}

	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	public static function findByUsername($user){
		return self::find()->where(['email'=>$user])->one();
	}

	public function validatePassword($password){
		return $this->password === hash("sha1", $password);
	}

	//Se actualiza la ultima conexion del usuario
	public function updateUltimaConexion(){
		$this->fecha_acceso=date("Y-m-d H:i:s");
		$this->save();
	}

	//Se actualiza la ultima conexion del usuario
	public function incrementNumAccesos(){
		$this->num_accesos+=1;
		$this->save();
	}

	//Reseteo de numero de accesos
	public function resetNumAccesos(){
		$this->num_accesos=0;
		$this->save();
	}

	//Se actualiza la fecha de bloqueo dada una
	public function updateFechaBloqueo($date){
		$this->fecha_bloqueo=$date;
		$this->save();
	}

	//Se bloquea un usuario según el tipo indicado
	public function bloquear($tipo){
		$this->bloqueado=$tipo;
		$this->save();
	}

	//Se obtiene la lista de zonas
	public static function listaZonas(){
		$tipos=Zona::listaZonas();
		$lista=ArrayHelper::map($tipos,'clase_zona_id', 'nombre');
		return $lista;
	}

	//Se obtiene el nombre de las zonas
	public static function getNombreZona($id){
		$lista=self::listaZonas();
		$res= (isset($lista[$id]) ? $lista[$id] : '<Nombre_Zona_'.$id.'>');
		return $res;
	}

	//Funcion estática para obtener el nombre de las zonas
	public function getDescripcionZona(){
		return static::getNombreZona($this->zona_id);
	}

	//Se obtiene la lista de roles predefinidos
	public static function listaRoles(){
		$roles=Rol::listaRoles();
		$lista=ArrayHelper::map($roles,'id', 'nombre');
		return $lista;
	}

	//Se obtiene el nombre de los roles
	public static function getNombreRol($inicial){
		$lista=self::listaRoles();
		$res= (isset($lista[$inicial]) ? $lista[$inicial] : '<Rol_'.$inicial.'>');
		return $res;
	}

	//Funcion estática para obtener el nombre de los roles
	/*public function getDescripcionRol(){
		return static::getNombreRol($this->rol);
	}*/

	//Lista de opciones para ver si el usuario está confirmado
	public static function listaOpciones(){
		$opciones= array(
			0=>'No',
			1=>'Sí',
		);
		return $opciones;
	}

	//Se obtiene la opcion
	public static function getOpcion($num){
		$lista=self::listaOpciones();
		$res= (isset($lista[$num]) ? $lista[$num] : '<Opcion_'.$num.'>');
		return $res;
	}

	//Se obtiene la opcion
	public function descripcionOpcion($id){
		return static::getOpcion($id);
	}

	//Lista de opciones para ver si el usuario está bloqueado
	public static function listaOpcionesBloqueo(){
		$opciones= array(
			0=>'No',
			1=>'Sí (Accesos)',
			2=>'Sí (Exceso establecimientos)',
			3=>'Sí (Comentarios denunciados)',
		);
		return $opciones;
	}

	public static function getOpcionBloqueo($num){
		$lista=self::listaOpcionesBloqueo();
		$res= (isset($lista[$num]) ? $lista[$num] : '<Opcion_'.$num.'>');
		return $res;
	}

	public function descripcionOpcionBloqueo($id){
		return static::getOpcionBloqueo($id);
	}

	/********************************************
	 * Funciones para comprobar rol del usuario
	 *
	 *******************************************/
	//Comporbar que el usuario indicado tenga rol moderador
	public static function esRolModerador($id){
		$rol=UsuarioRol::findOne(['id_usuario'=>$id, 'id_rol'=>1]);
		if(isset($rol) && $rol!=null)
			return true;
		else
			return false;
	}

	//Comporbar que el usuario indicado tenga rol patrocinador
	public static function esRolPatrocinador($id){
		$rol=UsuarioRol::findOne(['id_usuario'=>$id, 'id_rol'=>2]);
		if(isset($rol) && $rol!=null)
			return true;
		else
			return false;
	}

	//Comporbar que el usuario indicado tenga rol admin
	public static function esRolAdmin($id){
		$rol=UsuarioRol::findOne(['id_usuario'=>$id, 'id_rol'=>3]);
		if(isset($rol) && $rol!=null)
			return true;
		else
			return false;
	}

	/****************************
	* Obtener avisos del usuario
 	*****************************/
	public function getAvisos(){
		return $this->hasMany(UsuarioAviso::class, [
			'destino_usuario_id'=>'id',
		]);
	}

	/*****************************************************+
	 * Obtener la zona de moderación asociada al usuario
	 * ****************************************************/
	public function getZonasModeracion(){
		return $this->hasOne(UsuarioAreaModeracion::class, [
			'usuario_id'=>'id',
		]);
	}
}
