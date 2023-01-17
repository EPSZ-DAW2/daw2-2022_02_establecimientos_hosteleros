<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\LocalesEtiquetas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LocalesEtiquetasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Locales Etiquetas');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="locales-etiquetas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        NavBar::begin([
            'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
        ]);
        $items=[
            ['label' => 'Locales', 'url' => ['/locales-mantenimiento/index']],
            ['label' => 'Etiquetas', 'url' => ['/locales-etiquetas/index']],
            ['label' => 'Imagenes', 'url' => ['/locales-imagenes/index']],
            ['label' => 'Seguidos', 'url' => ['/usuarios-locales/index']],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $items,
        ]);
        NavBar::end();
    ?>
    <p>
        <?= Html::a(Yii::t('app', 'Añadir etiquetas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'local_id',
            'etiqueta_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, LocalesEtiquetas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
