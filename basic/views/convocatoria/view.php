<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Convocatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="convocatoria-view">
    <?php 
        $id=Yii::$app->user->id;
        //realmente es si aquí tuviera permisos de editar pero por ahora solo que este log
        if($id != Null){
    
    ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
    <?= Html::a('ver asistentes', ['ver', 'id' => $model->id,'id_local' => $model->local_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php }?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'local_id',
            'texto:ntext',
            'fecha_desde',
            'fecha_hasta',
            'num_denuncias',
            'fecha_denuncia1',
            'bloqueada',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
        ],
    ]) ?>

</div>
