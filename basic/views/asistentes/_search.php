<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AsistenteSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asistente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'local_id') ?>
    <?= $form->field($searchModel, 'localNombre')->label('localNombre')?>

    <?= $form->field($model, 'convocatoria_id') ?>
     <?= $form->field($searchModel, 'usuarioNombre')->label('usuarioNombre')?>
     <?= $form->field($searchModel, 'usuarioApellidos')->label('usuarioApellidos')?>
    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'fecha_alta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
