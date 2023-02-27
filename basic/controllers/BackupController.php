<?php

namespace app\controllers;
use app\models\UsuarioRol;
use yii\web\Controller;
use app\commands\CopiaController;
use yii\helpers\FileHelper;
use Yii;
//Para la parte de Angel
use app\models\Usuario;
class BackupController extends \yii\web\Controller
{


    public function beforeAction($action)
    
 
    { 
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            $this->layout='privada';
        	Yii::$app->homeUrl=array('locales/index');
			}
            return parent::beforeAction($action);
    }
    public function actionIndex()
    { 
        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
          //en caso de que la carpeta no se haya cargado por alguna razón la volvemos a crear si no existe
          $backupPath = \Yii::getAlias('@app/backups');
          if (!file_exists($backupPath)) {
              FileHelper::createDirectory($backupPath);
          }
         $model= opendir('../backups');
        return $this->render('index',['model'=>$model]); // aquí le voy a pasar la carpeta  de los backups 
        }
    }
    
    public function actionCopia($btn){
      if($btn=='si')
      {
        $comando = new CopiaController('create', Yii::$app);
        $comando->runAction('create');
        $model= opendir('../backups');
        return $this->render('index',['model'=>$model]); // aquí le voy a pasar la carpeta  de los backups 
      }
    }
    public function actionRestaurar($archivo){
        
      $comando = new CopiaController('restore', Yii::$app);
      $comando->ActionRestore($archivo);
      $model= opendir('../backups');
      return $this->render('index',['model'=>$model]); // aquí le voy a pasar la carpeta  de los backups 
    }

}
