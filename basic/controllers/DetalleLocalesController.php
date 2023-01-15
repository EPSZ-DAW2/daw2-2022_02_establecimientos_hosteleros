<?php

namespace app\controllers;

use app\models\LocalesMantenimiento;
use app\models\LocalesComentarios;
use Yii;


class DetalleLocalesController extends \yii\web\Controller
{
    //se pasa el id del local que el usuario clique
    public function actionIndex($idLocal)
    {
        $info=LocalesMantenimiento::listarinfolocal($idLocal);
        $mediaVal=LocalesMantenimiento::mediaValoraciones($idLocal);
        $comentarios=LocalesComentarios::listarcomentarios($idLocal);
        return $this->render('index',['info'=>$info,'mediaVal'=>$mediaVal,'comentarios'=>$comentarios]);
    }
   // public function denunciarLocal(){
        
    //}


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
}
