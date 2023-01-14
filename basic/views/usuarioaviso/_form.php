<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarioaviso $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarioaviso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'fecha_aviso')->textInput(['value' => date('Y-m-d H:i:s'), 'readonly' => true]) ?>

    <?php //= $form->field($model, 'clase_aviso_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'clase_aviso_id')->dropDownList( \app\models\Usuarioaviso::listaAvisos()) ?>


    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'destino_usuario_id')->textInput() ?>

    <?php //= $form->field($model, 'origen_usuario_id')->textInput() ?>

    <?= $form->field($model, 'local_id')->textInput() ?>

    <?= $form->field($model, 'comentario_id')->textInput() ?>

    <?php //= $form->field($model, 'fecha_lectura')->textInput() ?>

    <?php //= $form->field($model, 'fecha_aceptado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
