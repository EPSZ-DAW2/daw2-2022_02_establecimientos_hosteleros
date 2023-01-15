<?php

use app\models\Usuarioaviso;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuario $modelUsuario */

$this->title = Yii::t('app', 'Mi perfil');
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
	['label' => 'Mensajes', 'url' => ['/mensajes']],
];
echo Nav::widget([
	'options' => ['class' => 'navbar-nav'],
	'items' => $items,
]);
NavBar::end();
?>

<div>
    <?php echo $this->render('_datos',['model'=>$modelUsuario]);?>

</div>
<<<<<<< Updated upstream
<div class="container">
    <?php echo $this->render('_avisosRecibidos',['model'=>$modelAvisosRecibidos]);?>
</div>

<div class="container">
    <?php echo $this->render('_avisosEnviados',['model'=>$modelAvisosEnviados]);?>
</div>
=======
>>>>>>> Stashed changes
