<?php

use app\models\Convocatoria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\Column;
use app\models\Asistente;
use yii\widgets\ActiveForm;

//para el tema de roles

use app\models\UsuarioRol;

//Para la parte de Angel
use app\models\Usuario;


use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;


/** @var yii\web\View $this */
/** @var app\models\ConvocatoriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Convocatorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convocatoria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

        if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            echo Html::a('Crear Convocatoria', ['create'], ['class' => 'btn colorlogin mt-2']);
        } else {
            NavBar::begin([
                'brandLabel' => '',
                'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
            ]);
            $items=[
                ['label' => 'Ver Convoctorias', 'url' => ['convocatoria/index']],
                ['label' => 'Crear convoctorias', 'url' => ['convocatoria/create']],
                ['label' => 'Administrar convocatorias propias', 'url' => ['convocatoria/verpropias']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => $items,
            ]);
            NavBar::end();
        }

    
    //echo $this->render('_search1', ['model' => $searchModel]); ?>
      
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

              //'id',
           // 'local_id',
           'titulo',
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
                return '<a href="'.Url::to(['convocatoria/ver', 'id' => $model->id, 'id_local' => $model->local_id]).'" class="btn pl-2 pr-2 mb-0 btn-default">Ver asistentes</a>';
            },
               
            ],],
    ]);
    
    ?>


</div>
