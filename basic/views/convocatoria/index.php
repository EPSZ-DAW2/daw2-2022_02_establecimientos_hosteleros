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

    <p>
        <?= Html::a('Create Convocatoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'local_id',
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
            ],
            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model){
                    //si ya se ha reportado en esta sesión tiene que existir la variable o ser diferente de 0
                    //en este caso aparece el botón bloqueado
                    if(isset($_SESSION['REPORT_VECES']) && $_SESSION['REPORT_VECES']!=0){
                        $btn = '<a data-toggle="tooltip title="Members">Usted ya ha reportado</a>';
                    } else {
                        $btn = '<a href="'.Url::toRoute(["reportar", 'id' => $model->id]).'"
                    data-toggle="tooltip title="Members" data-placement="bottom" class="btn btn-sm"
                    btn-info ">Reportar</a>';
                    }
                    
                    return $btn;
                 }
            ],
            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model){
                    //Si no se está logueado
                    /*if(Yii::$app->user->id===NULL){
                        $btn = '<a href="http://localhost/web2/daw2-2022_02_establecimientos_hosteleros/basic/web/index.php?r=site%2Flogin"
                        data-toggle="tooltip title="Members" data-placement="bottom" class="btn btn-sm"
                        btn-info ">Loging</a>';
                    } else {*/
                        //Crear una busqueda en Asistente
                        $id_asistente = 7;
                        //$id_asistente =Yii::$app->user->id;
                        //$asistente= Asistente::findAll(['convocatoria_id' => $model->getId() ,'usuario_id' => Yii::$app->user->id ]);
                        $asistente= Asistente::findAll(['convocatoria_id' => $model->getId() ,'usuario_id' => $id_asistente ]);
                        //echo("AAA:".Yii::$app->user->id);
                        //var_dump($asistente);
                        //$model_asistente = $asistente->find()->comprobar_asistencia(Yii::app->user->id,$model->getId())->all();

                        //si ya está suscrito al $model->id
                        if(!empty($asistente)){ //sale el botón desuscribirse (Se hace una busqueda con el id del modelo y el del usuario)
                            $btn = '<a href="'.Url::toRoute(["desinscribir", 'id' => $model->id]).'"
                        data-toggle="tooltip title="Members" data-placement="bottom" class="btn btn-sm"
                        btn-info ">desuscribirse</a>';
                        } else { //ale el botón de suscribirse
                            $btn = '<a href="'.Url::toRoute(["inscribir", 'id' => $model->id]).'"
                        data-toggle="tooltip title="Members" data-placement="bottom" class="btn btn-sm"
                        btn-info ">Incribirse</a>';
                        }
                    //}
                    
                    return $btn;
                 }
            ],
        ],
    ]); ?>


</div>
