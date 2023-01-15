<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locales".
 *
 * @property int $id
 * @property string $titulo Titulo corto o slogan para el establecimiento/local.
 * @property string|null $descripcion Descripción breve del establecimiento/local o NULL si no es necesaria.
 * @property string|null $lugar Descripcion del lugar del establecimiento/local o NULL si no se conoce, aunque no debería estar vacío este dato.
 * @property string|null $url Dirección web externa (opcional) que enlaza con la página "oficial" o directamente del establecimiento/local o NULL si no hay o no se conoce.
 * @property int|null $zona_id Area/Zona de ubicación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).
 * @property int|null $categoria_id Categoria de clasificación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).
 * @property string|null $imagen_id Nombre identificativo (fichero interno) con la imagen principal o "de presentación" del establecimiento/local, o NULL si no hay.
 * @property int $sumaValores Suma acumulada de las valoraciones para el establecimiento/local.
 * @property int $totalVotos Contador de votos (valoraciones) emitidas para el establecimiento/local.
 * @property int|null $hostelero_id Hostelero/Propietario del establecimiento/local o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).
 * @property int $prioridad Indicador de importancia para el establecimiento/local en caso de tener hostelero.
 * @property int $visible Indicador de establecimiento/local visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.
 * @property int $terminado Indicador de establecimiento/local terminado o suspendido: 0=No, 1=Eliminado por usuario, 2=Suspendido, 3=Cancelado por inadecuado, ...
 * @property string|null $fecha_terminacion Fecha y Hora de terminación del establecimiento/local. Debería estar a NULL si no está terminado.
 * @property int $num_denuncias Contador de denuncias del establecimiento/local o CERO si no ha tenido.
 * @property string|null $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property int $bloqueado Indicador de establecimiento/local bloqueada: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo del establecimiento/local. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo del establecimiento/local o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 * @property int $cerrado_comentar Indicador de establecimiento/local cerrado para comentarios: 0=No, 1=Si.
 * @property int $cerrado_quedar Indicador de establecimiento/local cerrado para quedadas: 0=No, 1=Si.
 * @property int|null $crea_usuario_id Usuario que ha creado el establecimiento/local o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación del establecimiento/local o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado el establecimiento/local por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación del establecimiento/local o NULL si no se conoce por algún motivo.
 * @property string|null $notas_admin Notas adicionales para los moderadores/administradores sobre el establecimiento/local o NULL si no hay.
 */
class LocalesMantenimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['titulo', 'descripcion', 'lugar', 'url', 'notas_bloqueo', 'notas_admin'], 'string'],
            [['zona_id', 'categoria_id', 'sumaValores', 'totalVotos', 'hostelero_id', 'prioridad', 'visible', 'terminado', 'num_denuncias', 'bloqueado', 'cerrado_comentar', 'cerrado_quedar', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['fecha_terminacion', 'fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['imagen_id'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titulo' => Yii::t('app', 'Titulo corto o slogan para el establecimiento/local.'),
            'descripcion' => Yii::t('app', 'Descripción breve del establecimiento/local o NULL si no es necesaria.'),
            'lugar' => Yii::t('app', 'Descripcion del lugar del establecimiento/local o NULL si no se conoce, aunque no debería estar vacío este dato.'),
            'url' => Yii::t('app', 'Dirección web externa (opcional) que enlaza con la página \"oficial\" o directamente del establecimiento/local o NULL si no hay o no se conoce.'),
            'zona_id' => Yii::t('app', 'Area/Zona de ubicación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).'),
            'categoria_id' => Yii::t('app', 'Categoria de clasificación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).'),
            'imagen_id' => Yii::t('app', 'Nombre identificativo (fichero interno) con la imagen principal o \"de presentación\" del establecimiento/local, o NULL si no hay.'),
            'sumaValores' => Yii::t('app', 'Suma acumulada de las valoraciones para el establecimiento/local.'),
            'totalVotos' => Yii::t('app', 'Contador de votos (valoraciones) emitidas para el establecimiento/local.'),
            'hostelero_id' => Yii::t('app', 'Hostelero/Propietario del establecimiento/local o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).'),
            'prioridad' => Yii::t('app', 'Indicador de importancia para el establecimiento/local en caso de tener hostelero.'),
            'visible' => Yii::t('app', 'Indicador de establecimiento/local visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.'),
            'terminado' => Yii::t('app', 'Indicador de establecimiento/local terminado o suspendido: 0=No, 1=Eliminado por usuario, 2=Suspendido, 3=Cancelado por inadecuado, ...'),
            'fecha_terminacion' => Yii::t('app', 'Fecha y Hora de terminación del establecimiento/local. Debería estar a NULL si no está terminado.'),
            'num_denuncias' => Yii::t('app', 'Contador de denuncias del establecimiento/local o CERO si no ha tenido.'),
            'fecha_denuncia1' => Yii::t('app', 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.'),
            'bloqueado' => Yii::t('app', 'Indicador de establecimiento/local bloqueada: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha y Hora del bloqueo del establecimiento/local. Debería estar a NULL si no está bloqueado o si se desbloquea.'),
            'notas_bloqueo' => Yii::t('app', 'Notas visibles sobre el motivo del bloqueo del establecimiento/local o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.'),
            'cerrado_comentar' => Yii::t('app', 'Indicador de establecimiento/local cerrado para comentarios: 0=No, 1=Si.'),
            'cerrado_quedar' => Yii::t('app', 'Indicador de establecimiento/local cerrado para quedadas: 0=No, 1=Si.'),
            'crea_usuario_id' => Yii::t('app', 'Usuario que ha creado el establecimiento/local o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.'),
            'crea_fecha' => Yii::t('app', 'Fecha y Hora de creación del establecimiento/local o NULL si no se conoce por algún motivo.'),
            'modi_usuario_id' => Yii::t('app', 'Usuario que ha modificado el establecimiento/local por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.'),
            'modi_fecha' => Yii::t('app', 'Fecha y Hora de la última modificación del establecimiento/local o NULL si no se conoce por algún motivo.'),
            'notas_admin' => Yii::t('app', 'Notas adicionales para los moderadores/administradores sobre el establecimiento/local o NULL si no hay.'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LocalesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalesQuery(get_called_class());
    }
    //Se bloquea un local según el tipo indicado
	public function bloquear($tipo){
		$this->bloqueado=$tipo;
		$this->save();
	}
    //Lista de opciones para ver si el local está bloqueado
	public static function listaOpcionesBloqueo(){
		$opciones= array(
			0=>'No',
			1=>'Sí (Bloqueado por denuncias)',
			2=>'Sí (Bloqueado por administrador)',
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
    public function terminacion($tipo){
		$this->estado=$tipo;
		$this->save();
	}
    public static function listaOpcionesTerminacion(){
		$opciones= array(
			0=>'No',
			1=>'Eliminado por el usuario',
			2=>'Suspendido',
            3=>'Suspendido por inadecuado'
		);
		return $opciones;
	}

	public static function getOpcionTerminacion($num){
		$lista=self::listaOpcionesTerminacion();
		$res= (isset($lista[$num]) ? $lista[$num] : '<Opcion_'.$num.'>');
		return $res;
	}

	public function descripcionOpcionTerminacion($id){
		return static::getOpcionTerminacion($id);
	}
}
