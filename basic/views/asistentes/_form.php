<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Asistente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asistente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'local_id')->textInput() ?>

    <?= $form->field($model, 'convocatoria_id')->textInput() ?>

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'fecha_alta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
