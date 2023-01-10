<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Configuracion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="configuracion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'variable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
