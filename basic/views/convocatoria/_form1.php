<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="convocatoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'local_id')->textInput() ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_desde')->textInput() ?>

    <?= $form->field($model, 'fecha_hasta')->textInput() ?>

    <?= $form->field($model, 'num_denuncias')->hiddenInput([ 'value' => 0])->label(false) ?>

    <?= $form->field($model, 'bloqueada')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'crea_usuario_id')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
