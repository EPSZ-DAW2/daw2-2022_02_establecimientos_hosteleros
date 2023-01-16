<?php

use app\models\Convocatoria;
use app\models\Asistente;

//use Yii;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;



/** @var yii\web\View $this */
/** @var app\models\ConvocatoriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Convocatorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convocatoria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
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
                'template' => '{view}',
                'urlCreator' => function ($action, Convocatoria $model, $key, $index, $column) {
                    if($action === 'view'){
                        return Url::toRoute(['convocatoria/view', 'id' => $model->id]);
                    }
                    
                }
            ],
        ]
    ]); ?>


</div>
