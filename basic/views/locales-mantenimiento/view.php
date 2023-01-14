<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LocalesMantenimiento $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locales Mantenimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="locales-mantenimiento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titulo:ntext',
            'descripcion:ntext',
            'lugar:ntext',
            'url:ntext',
            'zona_id',
            'categoria_id',
            'imagen_id',
            'sumaValores',
            'totalVotos',
            'hostelero_id',
            'prioridad',
            'visible',
            'terminado',
            'fecha_terminacion',
            'num_denuncias',
            'fecha_denuncia1',
            'bloqueado',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
            'cerrado_comentar',
            'cerrado_quedar',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
            'notas_admin:ntext',
        ],
    ]) ?>

</div>
