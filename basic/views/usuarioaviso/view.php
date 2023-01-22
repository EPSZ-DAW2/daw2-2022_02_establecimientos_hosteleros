<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Usuarioaviso $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarioavisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
<div class="usuarioaviso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', "Marcar como 'No leído'"), ['desleer', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', "Aceptar"), ['aceptar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fecha_aviso',
            //'clase_aviso_id',
            [ 'attribute'=>'clase_aviso_id', 'value'=>$model->clase_aviso_id.' - '.$model->nombreAviso ],
            'texto:ntext',
            //'destino_usuario_id',
            [ 'attribute'=>'destino_usuario_id', 'value'=>$model->destino_usuario_id.' - '.$model->nickDestino ],
            //'origen_usuario_id',
            [ 'attribute'=>'origen_usuario_id', 'value'=>$model->origen_usuario_id.' - '.$model->nickOrigen ],
            //'local_id',
            [ 'attribute'=>'local_id', 'value'=>$model->local_id.' - '.$model->nombreLocal ],
            'comentario_id',
            'fecha_lectura',
            'fecha_aceptado',
        ],
    ]) ?>

</div>
