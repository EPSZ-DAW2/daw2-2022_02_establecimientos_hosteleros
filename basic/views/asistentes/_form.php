<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Asistente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asistente-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'local_id')->hiddeninput(['value'=> $local])->label(false) ?>

<?= $form->field($model, 'convocatoria_id')->hiddeninput(['value'=> $convocatoria])->label(false)?>

<?= $form->field($model, 'usuario_id')->textInput() ?>

<?= $form->field($model, 'fecha_alta')->hiddeninput(['value'=>date("Y-m-d h:i:sa")])->label(false)?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php 
    //echo $local;
?>

<?php ActiveForm::end();?>

</div>
