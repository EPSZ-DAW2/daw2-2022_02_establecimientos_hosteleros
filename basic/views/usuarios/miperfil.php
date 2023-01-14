<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuario $modelUsuario */

$this->title = Yii::t('app', 'Mi perfil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div>
    <?php $this->renderPartial('_datos',$modelUsuario);?>

</div>
