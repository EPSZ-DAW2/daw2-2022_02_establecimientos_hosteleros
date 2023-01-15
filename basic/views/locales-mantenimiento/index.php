<?php

use app\models\LocalesMantenimiento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LocalesMantenimientoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Locales Mantenimientos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locales-mantenimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Locales Mantenimiento'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
    ]); ?>


</div>
