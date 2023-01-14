<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Configuracion $model */

$this->title = $model->variable;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuraciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php
NavBar::begin([
	'brandLabel' => 'Administración Configuraciones',
	'brandUrl' => array('configuraciones/index'),
	'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
]);
$items=[
	['label' => 'Configuraciones', 'url' => ['/configuraciones/index']],
	['label' => 'Crear configuración', 'url' => ['/configuraciones/create']],
];
echo Nav::widget([
	'options' => ['class' => 'navbar-nav'],
	'items' => $items,
]);
NavBar::end();
?>
<div class="configuracion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'variable' => $model->variable], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'variable' => $model->variable], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de querer borrar esta configuración?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'variable',
            'valor:ntext',
        ],
    ]) ?>

</div>
