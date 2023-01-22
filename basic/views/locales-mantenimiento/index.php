<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\LocalesMantenimiento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;


/** @var yii\web\View $this */
/** @var app\models\LocalesMantenimientoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Mantenimiento de locales');
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="locales-mantenimiento-index">

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
        <?= Html::a(Yii::t('app', 'Crear local'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'titulo:ntext',
            'descripcion:ntext',
            'lugar:ntext',
            'url:ntext',
            //'zona_id',
            //'categoria_id',
            //'imagen_id',
            //'sumaValores',
            //'totalVotos',
            //'hostelero_id',
            //'prioridad',
            //'visible',
            //'terminado',
            //'fecha_terminacion',
            //'num_denuncias',
            //'fecha_denuncia1',
            //'bloqueado',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            //'cerrado_comentar',
            //'cerrado_quedar',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, LocalesMantenimiento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
         
    ]);
    ?>


</div>
