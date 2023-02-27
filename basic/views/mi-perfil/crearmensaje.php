<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuarioaviso $model */

$this->title = Yii::t('app', 'Enviar mensaje');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarioavisos'), 'url' => ['index']];
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

<div class="usuarioaviso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'msgError' => $msgError,
    ]) ?>

</div>
