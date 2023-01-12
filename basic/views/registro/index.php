<?php

use app\models\Registro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RegistroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Registros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Registro'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_registro',
            [ 'attribute'=>'clase_log_id',
                'filter'=> \app\models\Registro::listaEstados(),
                'content'=>function($model, $key, $index, $column) {
                    return $model->descripcionEstado;
                }
                , 'contentOptions' => ['class'=>'text-center']
            ],
            'modulo',
            'texto:ntext',
            'ip',
            'browser:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
