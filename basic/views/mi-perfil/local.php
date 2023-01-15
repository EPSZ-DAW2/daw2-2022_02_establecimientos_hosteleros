<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
/** @var app\models\Local $locales */
/** @var yii\web\View $this */



$this->title = Yii::t('app', 'Mis locales');
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
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $items,
]);
NavBar::end();
?>
<div class="container">
    <h1>Mis locales</h1>
    <div class="row">
        <?php
        foreach ($locales as $local){
            echo $this->render('_resumida', ['local'=>$local]);
        }
        ?>
    </div>
</div>

