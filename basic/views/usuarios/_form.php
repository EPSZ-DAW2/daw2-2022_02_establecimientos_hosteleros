<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'rol')->dropDownList($model::listaRoles()) ?>

	<?= $form->field($model, 'zona_id')->dropDownList($model::listaZonas()) ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

	<?= $form->field($model, 'confirmado')->dropDownList($model::listaOpciones()) ?>

    <?= $form->field($model, 'fecha_acceso')->textInput() ?>

    <?= $form->field($model, 'num_accesos')->textInput() ?>

	<?= $form->field($model, 'bloqueado')->dropDownList($model::listaOpciones()) ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
