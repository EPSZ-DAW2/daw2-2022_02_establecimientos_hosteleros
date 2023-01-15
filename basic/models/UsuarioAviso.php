<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_avisos".
 *
 * @property int $id
 * @property string $fecha_aviso Fecha y Hora de creación del aviso.
 * @property string $clase_aviso_id código de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...
 * @property string|null $texto Texto con el mensaje de aviso.
 * @property int|null $destino_usuario_id Usuario relacionado, destinatario del aviso, o NULL si no es para administración y aún no está gestionado.
 * @property int|null $origen_usuario_id Usuario relacionado, origen del aviso, o NULL si es del sistema.
 * @property int|null $local_id establecimiento/local relacionado o NULL si no tiene que ver directamente.
 * @property int|null $comentario_id Comentario relacionado o NULL si no tiene que ver directamente con un comentario.
 * @property string|null $fecha_lectura Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.
 * @property string|null $fecha_aceptado Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.
 */
class Usuarioaviso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_avisos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_aviso'], 'required'],
            [['fecha_aviso', 'fecha_lectura', 'fecha_aceptado'], 'safe'],
            [['texto'], 'string'],
            [['destino_usuario_id', 'origen_usuario_id', 'local_id', 'comentario_id'], 'integer'],
            [['clase_aviso_id'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_aviso' => Yii::t('app', 'Fecha Aviso'),
            'clase_aviso_id' => Yii::t('app', 'Clase Aviso ID'),
            'texto' => Yii::t('app', 'Texto'),
            'destino_usuario_id' => Yii::t('app', 'Destino Usuario ID'),
            'origen_usuario_id' => Yii::t('app', 'Origen Usuario ID'),
            'local_id' => Yii::t('app', 'Local ID'),
            'comentario_id' => Yii::t('app', 'Comentario ID'),
            'fecha_lectura' => Yii::t('app', 'Fecha Lectura'),
            'fecha_aceptado' => Yii::t('app', 'Fecha Aceptado'),
            
            //Atributos virtuales
            'nombreAviso' => Yii::t('app', 'Aviso'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuarioavisoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioavisoQuery(get_called_class());
    }

    /**
     * Lista de posibles avisos.
     */
    public static function listaAvisos()
    {
        return [
              'A' => 'Aviso'
            , 'N' => 'Notificación'
            , 'D' => 'Denuncia'
            , 'C' => 'Consulta'
            , 'M' => 'Mensaje'
            , 'B' => 'Bloqueo'
        ];
    }//listaAvisos

    /**
     * Nombre del código de clase de aviso.
     */
    public static function nombreAviso( $aviso)
    {
        $lista= static::listaAvisos();
 
        $res= (isset( $lista[$aviso]) ? $lista[$aviso] : null);
        return $res;
    }//nombreAviso
  
    /**
     * Atributo virtual con la descripcion del código de clase de aviso.
     */
    public function getNombreAviso()
    {
        return static::nombreAviso( $this->clase_aviso_id);
    }//getNombreAviso

    /**
     * Recoge todos los avisos enviados
     */
    public static function getAvisosEnviados($id)
    {
        return usuarioaviso::find()->where(['origen_usuario_id' => $id])->all();
    }//getAvisosEnviados

    /**
     * Recoge todos los avisos recibidos
     */
    public static function getAvisosRecibidos($id)
    {
        return usuarioaviso::find()->where(['destino_usuario_id' => $id])->all();
    }//getAvisosRecibidos



    /**
     * Devuelve los datos del mensaje
     */
    public static function getMensaje($id)
    {
        return usuarioaviso::find()->where(['id' => $id])->all();
    }

    /**
     * Deslee un mensaje en concreto
     */
    public function desleer($id){
        $model = $this->findModel($id);
        $model->fecha_lectura=null;
        $model->save();
    }

    public function encontrar($id){
        return $this->findModel($id);
    }
    /**
     * Finds the Usuarioaviso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuarioaviso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Usuarioaviso::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
