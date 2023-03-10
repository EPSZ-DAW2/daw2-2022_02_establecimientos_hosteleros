<?php

namespace app\controllers;

use app\models\Usuario;

use app\models\Configuracion;
use app\models\LocalesMantenimiento;
use app\models\LocalesComentarios;
use app\models\UsuariosLocales;
use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class DetalleLocalesController extends \yii\web\Controller
{

    /*
	 * Función sobreescrita para comprobar que layout usar
	 * y que homeUrl definir según el rol del usuario
	 * */
	public function beforeAction($action)
	{
		if(!Yii::$app->user->isGuest){
			if(Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id)){
				$this->layout='privada';
				Yii::$app->homeUrl=array('local/index');
			}

		}else{
			$this->layout='publica';
			Yii::$app->homeUrl=array('local/index');
		}

		return parent::beforeAction($action);
	}


    //se pasa el id del local que el usuario clique
    public function actionIndex($idLocal)
    {
        $info=LocalesMantenimiento::listarinfolocal($idLocal);
        $mediaVal=LocalesMantenimiento::mediaValoraciones($idLocal);
        $comentarios=LocalesComentarios::listarcomentarios($idLocal);
        $count = LocalesComentarios::num_comentarios($idLocal);
        

        $query = LocalesComentarios::find()
                    ->where(['local_id'=>$idLocal])
                    ->where(['comentario_id'=>0]);
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count(), 'pageSize'=>5]); 
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index',['info'=>$info,'mediaVal'=>$mediaVal,'models'=>$models, 'pages' => $pages,]);
    }


    public function actionDenunciarlocal($idLocal){
        $modelo = new LocalesMantenimiento();
        $modelo->denunciar($idLocal);
        $info=LocalesMantenimiento::listarinfolocal($idLocal);
        if ($info[0]['num_denuncias']==10){$modelo->bloquear($idLocal,1);}
        
        return $this->goBack(Yii::$app->request->referrer);
        
    }


    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }




    public function actionFollow($usuario_id, $local_id){
        $model = new UsuariosLocales();
        $sigue = $model->comprobarSeguimiento($usuario_id, $local_id);

        if($sigue === false){
            $relacion = new UsuariosLocales();
            $relacion->usuario_id = $usuario_id;
            $relacion->local_id = $local_id;
            $relacion->fecha_alta = date('Y-m-d H:i:s');
            $relacion->save();
        }
        return $this->goBack(Yii::$app->request->referrer);
    }

    
    public function actionUnfollow($local_id,$usuario_id){
        $model = $this->findModel($usuario_id);

        //Comprobar si existe
        $comprobar=UsuariosLocales::find()->where(['usuario_id'=>$usuario_id, 'local_id'=>$local_id]);

        //Si existe hay que borrarlo
        if($comprobar->count()==1){
            $comprobar->one()->delete();
        }

        return $this->goBack(Yii::$app->request->referrer);
    }


    public function actionComentarios($local_id){
        $model = new LocalesComentarios();

        $model->listarcomentarios($local_id);
        $model->setPagination(['pageSize'=>1]);
        return $model;
    }

    public function actionComentar(){
        $model = new LocalesComentarios();

        if($model->load(Yii::$app->request->post())){
            $model->crea_fecha = date('Y-m-d H:i:s');
            $model->agregarcomentario($model->local_id, $model->valoracion, $model->texto, $model->cerrado, $model->crea_usuario_id, $model->comentario_id);
            return $this->goBack(Yii::$app->request->referrer);
        }
    }

}
