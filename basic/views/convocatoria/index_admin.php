<?php

use app\models\Convocatoria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\Column;
use app\models\Asistente;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var app\models\ConvocatoriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Convocatorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convocatoria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Convocatoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  // echo $this->render('_search', ['model' => $searchModel]); ?>
      
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           // 'local_id',
            'localNombre',
            'texto:ntext',
            'fecha_desde',
            'fecha_hasta',
            //'num_denuncias',
            //'fecha_denuncia1',
            //'bloqueada',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Convocatoria $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);  
                 }
            ], [ 'label' => 'ver asistentes',
            'format' => 'html',
            'content' => function($model, $key, $index) {
                return '<a href="'.Url::toRoute(['convocatoria/ver', 'id' => $model->id, 'id_local' => $model->local_id]).'" class="btn btn-danger">Ver asistentes</a>';
            },
               
            ],],
    ]);
    
    ?>


</div>