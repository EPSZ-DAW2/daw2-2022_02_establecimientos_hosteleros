<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LocalesEtiquetas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="locales-etiquetas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'local_id')->textInput() ?>

    <?= $form->field($model, 'etiqueta_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
