<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de querer borrar este usuario?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'password',
            'nick',
            'nombre',
            'apellidos',
            'fecha_nacimiento',
            'direccion:ntext',
			[
				'attribute'=>'rol',
				'value'=> $model->rol.'-'.$model->getDescripcionRol(),
			],
			[
				'attribute'=>'zona_id',
				'value'=> $model->zona_id.'-'.$model->getDescripcionZona(),
			],
            'fecha_registro',
			[
				'attribute'=>'confirmado',
				'value'=> $model->descripcionOpcion($model->confirmado),
			],
            'fecha_acceso',
            'num_accesos',
			[
				'attribute'=>'bloqueado',
				'value'=> $model->descripcionOpcion($model->bloqueado),
			],
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
        ],
    ]) ?>

</div>
