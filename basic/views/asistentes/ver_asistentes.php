 <?php

use app\models\Asistente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
<<<<<<< Updated upstream

=======
use yii\grid\Column;
use yii\widgets\ActiveForm;
>>>>>>> Stashed changes
/** @var yii\web\View $this */
/** @var app\models\AsistenteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Asistentes';
$this->params['breadcrumbs'][] = ['label' => 'Convocatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistente-index">

    <h1><?= Html::encode($this->title) ?></h1>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
<<<<<<< Updated upstream
=======
         'filterModel' => $searchModel,
>>>>>>> Stashed changes
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'local_id',
            'convocatoria_id',
            'usuario_id',
            'fecha_alta',
<<<<<<< Updated upstream
            ['label'=>'raw','format'=>'raw','value'=>function($model){$btn='<a  href="'.Url::toRoute(['asistentes/delete', 'id' => $model->id]).'"data-toggle="tooltip title="Members" data-placement="bottom" class="btn btn-sm" btn-info">Borrar</a>';
                return $btn; 
                 }
            ]
        ],
    ]); ?>
    
=======
            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
            'urlCreator' => function ($action, Asistente $model, $key, $index, $column) {
                if ($action === 'delete') {
                    return Url::to(['asistentes/delete', 'id' => $model->id]);
                }
            },
            ]
        ],
    ]); ?>




>>>>>>> Stashed changes
    <p>
    <a href="<?= Url::toRoute(['asistentes/create','id' => $convocatoria,'id_local'=>$local]);?>">Añadir asistente</a>
    </p>
   


</div>

          