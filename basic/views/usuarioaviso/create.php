<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuarioaviso $model */

$this->title = Yii::t('app', 'Crear Aviso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarioavisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
NavBar::begin([
	'brandLabel' => 'Administración Avisos',
	'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
]);
$items=[
	['label' => 'Avisos', 'url' => ['/usuarioaviso/index']],
	['label' => 'Crear aviso', 'url' => ['/usuarioaviso/create']],
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
    ]) ?>

</div>
