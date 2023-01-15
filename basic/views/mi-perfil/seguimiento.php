<?php

use app\models\Local;
use app\models\Usuarioaviso;
use app\models\UsuariosLocales;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UsuariosLocales   $models */

$this->title = Yii::t('app', 'Locales seguidos');
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
	['label' => 'Establecimientos', 'url' => ['/mi-perfil/establecimientos']],
	['label' => 'Seguidos', 'url' => ['/mi-perfil/seguimiento']],
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $items,
]);
NavBar::end();
?>
<div class="container">
    <div class="row">
        <?php
        foreach($models as $model){
            $local=Local::findOne(['id'=>$model->local_id]);
            echo $this->render('/local/ficha_resumida', ['local'=>$local]);
        }
        ?>
    </div>
</div>


