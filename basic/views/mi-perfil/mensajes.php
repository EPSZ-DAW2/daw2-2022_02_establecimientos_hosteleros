<?php

use app\models\Usuarioaviso;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UsuarioAviso $modelAvisosEnviados */
/** @var app\models\UsuarioAviso $modelAvisosRecibidos */



$this->title = Yii::t('app', 'Mis Mensajes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MiPerfil'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
NavBar::begin([
	'brandLabel' => 'Mi perfil',
	'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
]);
$items=[
	['label' => 'Perfil', 'url' => ['/mi-perfil']],
	['label' => 'Mensajes', 'url' => ['/mi-perfil/mensajes']],
	['label' => 'Locales', 'url' => ['/mi-perfil/establecimientos']],
	['label' => 'Seguidos', 'url' => ['/mi-perfil/seguimiento']],
	['label' => 'Comentarios', 'url' => ['/mi-perfil/comentarios']],
];
echo Nav::widget([
	'options' => ['class' => 'navbar-nav'],
	'items' => $items,
]);
NavBar::end();
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="form-group mt-2">
	<?= Html::a(Yii::t('app', 'Enviar mensaje'), ['crearmensaje'], ['class' => 'btn btn-success']) ?>
</div>

<div class="container">
   <?php echo $this->render('_avisosRecibidos',['model'=>$modelAvisosRecibidos]);?>
</div>

<div class="container">

    <?php echo $this->render('_avisosEnviados',['model'=>$modelAvisosEnviados]);?>
</div>