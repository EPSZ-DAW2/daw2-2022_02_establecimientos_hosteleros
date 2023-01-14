<?php

namespace app\controllers;

use app\models\Usuario;
use app\models\UsuarioAviso;
use app\models\UsuarioRol;
use app\models\UsuariosSearch;
use app\models\UsuarioAvisoSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuario model.
 */
class MiPerfilController extends Controller
{


    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Usuario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $id = $_SESSION['__id']; //id del usuario_origen
        if($id==null) {
            $this->layout='publica';
            Yii::$app->homeUrl=array('local/index');
        }
        //-Datos del usuario
        $searchModelUsuario = new UsuariosSearch();
        $modelUsuario = $searchModelUsuario->findIdentity($id);
        //-Avisos relacionados con el usuario
        $searchModelAvisosEnviados = new Usuarioaviso();
        $modelAvisosEnviados= UsuarioAviso::getAvisosEnviados($id);


        //$modelAvisos= Usuarioaviso::findOne($id);
        return $this->render('miperfil', [
            'modelUsuario' => $modelUsuario,
            'modelAvisosEnviados'=>$modelAvisosEnviados,

        ]);
    }


}