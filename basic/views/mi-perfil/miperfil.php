<?php

use app\models\Usuarioaviso;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuario $modelUsuario */
/** @var app\models\UsuarioAviso $modelAvisosEnviados */
/** @var app\models\UsuarioAviso $modelAvisosRecibidos */

$this->title = Yii::t('app', 'Mi perfil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MiPerfil'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div>
    <?php echo $this->render('_datos',['model'=>$modelUsuario]);?>

</div>
<div>
    <?php echo $this->render('_avisosRecibidos',['model'=>$modelAvisosRecibidos]);?>
    <?php echo $this->render('_avisosEnviados',['model'=>$modelAvisosEnviados]);?>
</div>