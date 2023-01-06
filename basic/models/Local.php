<?php

namespace app\models;

use \app\models\Categoria;
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
class Local extends \yii\db\ActiveRecord
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
            'titulo' => Yii::t('app', 'Titulo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'lugar' => Yii::t('app', 'Lugar'),
            'url' => Yii::t('app', 'Url'),
            'zona_id' => Yii::t('app', 'Zona ID'),
            'categoria_id' => Yii::t('app', 'Categoria ID'),
            'imagen_id' => Yii::t('app', 'Imagen ID'),
            'sumaValores' => Yii::t('app', 'Suma Valores'),
            'totalVotos' => Yii::t('app', 'Total Votos'),
            'hostelero_id' => Yii::t('app', 'Hostelero ID'),
            'prioridad' => Yii::t('app', 'Prioridad'),
            'visible' => Yii::t('app', 'Visible'),
            'terminado' => Yii::t('app', 'Terminado'),
            'fecha_terminacion' => Yii::t('app', 'Fecha Terminacion'),
            'num_denuncias' => Yii::t('app', 'Num Denuncias'),
            'fecha_denuncia1' => Yii::t('app', 'Fecha Denuncia1'),
            'bloqueado' => Yii::t('app', 'Bloqueado'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha Bloqueo'),
            'notas_bloqueo' => Yii::t('app', 'Notas Bloqueo'),
            'cerrado_comentar' => Yii::t('app', 'Cerrado Comentar'),
            'cerrado_quedar' => Yii::t('app', 'Cerrado Quedar'),
            'crea_usuario_id' => Yii::t('app', 'Crea Usuario ID'),
            'crea_fecha' => Yii::t('app', 'Crea Fecha'),
            'modi_usuario_id' => Yii::t('app', 'Modi Usuario ID'),
            'modi_fecha' => Yii::t('app', 'Modi Fecha'),
            'notas_admin' => Yii::t('app', 'Notas Admin'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LocalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalQuery(get_called_class());
    }

	public static function listaZonas()
	{
		$zonas= array(
			0=>'Sin informar',
			1=>'Continente',
			2=>'País',
			3=>'Estado',
			4=>'Región',
			5=>'Provincia',
			6=>'Municipio',
			7=>'Barrio',
			8=>'Área',
		);
		return $zonas;
	}

	public function getCategoria(){
		return $this->hasOne(Categoria::class, [
			'id'=>'categoria_id',
		]);
	}
}
