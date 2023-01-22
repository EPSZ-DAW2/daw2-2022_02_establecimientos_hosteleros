<?php

use app\models\Local;
use app\models\Usuarioaviso;
use app\models\UsuariosLocales;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UsuariosLocales   $models */

$this->title = Yii::t('app', 'Mis locales seguidos');
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
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($models==null){?>
    <div class="row">
        <h3>No sigue ningún local</h3>
    </div>
     <?php } else{ ?>
        <div class="row">
        <?php
        foreach($models as $model){
            $local=Local::findOne(['id'=>$model->local_id]);
            echo $this->render('/local/ficha_resumida', ['local'=>$local]);
        }
        ?>
    </div>
    <?php } ?>
</div>


