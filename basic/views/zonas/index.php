<?php

use app\models\Zonas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ZonasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Zonas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zonas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Zonas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            /*[
                'label' => 'Tipo de Zona',
                'format' => 'html',
                'content' => function($model, $key, $index) {
                    $tipo = $model->listaZonas()[$model->clase_zona_id];
                return $tipo ;
                }   
            ],*/
            [
                'label' => 'Tipo de Zona',
				'attribute'=>'clase_zona_id',
				'content'=> function($model, $key, $index, $column){
					return $model->listaZonas()[$model->clase_zona_id];
				},
				'contentOptions'=>['class'=>'text-center'],
				'filter'=>\app\models\Zonas::listaZonas(),
			],
            //'clase_zona_id',
            'nombre',
            //'zona_id',
            'padre_Nombre',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
