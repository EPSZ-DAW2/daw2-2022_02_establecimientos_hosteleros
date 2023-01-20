<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\Configuracion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ConfiguracionesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Configuraciones');
$this->params['breadcrumbs'][] = $this->title;
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
<div class="configuracion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
            <?= Html::a(Yii::t('app', 'Crear configuración'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           

            'variable',
            'valor:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'variable' => $model->variable]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
