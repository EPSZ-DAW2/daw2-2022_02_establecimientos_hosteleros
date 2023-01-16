<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\Usuarioaviso;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UsuarioavisoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Avisos');
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
<div class="usuarioaviso-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a(Yii::t('app', 'Create Usuario aviso'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fecha_aviso',
            //'clase_aviso_id',
            [ 'attribute'=>'clase_aviso_id',
                'filter'=> \app\models\Usuarioaviso::listaAvisos(),
                'content'=>function($model, $key, $index, $column) {
                    return $model->nombreAviso;
                }
                , 'contentOptions' => ['class'=>'text-center']
            ],
            'texto:ntext',
            'destino_usuario_id',
            'origen_usuario_id',
            //'local_id',
            //'comentario_id',
            'fecha_lectura',
            //'fecha_aceptado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Usuarioaviso $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
