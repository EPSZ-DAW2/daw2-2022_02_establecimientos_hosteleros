 <?php

use app\models\Asistente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\Column;
use yii\widgets\ActiveForm;
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
        'filterModel' => $searchModel,
        'columns' => [
         

            //'id',
           // 'local_id',
            'titulo',
            'nombre' ,
            'apellidos',
            //'convocatoria_id',
            'usuario_id',
            //'fecha_alta',
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




    <p>
    <a href="<?= Url::toRoute(['asistentes/create','id' => $convocatoria,'id_local'=>$local]);?> class="class="btn pl-2 pr-2 mb-0 btn-default">Añadir asistente</a>
    </p>
   


</div>

          