<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->widget(\yii\jui\DatePicker::className(),
        [ 'dateFormat' => 'php:Y/m/d',
            'language' => 'es',
            'clientOptions' => [
                'changeYear' => true,
                'changeMonth' => true,
                'yearRange' => '-50:-12',
                'altFormat' => 'yyyy-mm-dd',
            ]],['placeholder' => 'dd/mm/yyyy'])
        ->textInput(['placeholder' => \Yii::t('app', 'dd/mm/yyyy')]) ;?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'zona_id')->dropDownList($model::listaZonas()) ?>

<?= $form->field($model, 'fecha_registro')->textInput(['readonly' => true]) ;?>


    <div class="form-group mt-2">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton(Yii::t('app', 'Cambiar contraseña'), ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton(Yii::t('app', 'Dar de baja'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>