<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Asistente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asistente-form">

<?php $form = ActiveForm::begin(); ?>

<<<<<<< Updated upstream
<?= $form->field($model, 'local_id')->hiddeninput(['value'=> $local]) ?>

<?= $form->field($model, 'convocatoria_id')->hiddeninput(['value'=> $convocatoria])?>

<?= $form->field($model, 'usuario_id')->textInput() ?>

<?= $form->field($model, 'fecha_alta')->hiddeninput(['value'=>date("Y-m-d h:i:sa")])?>
=======
<?= $form->field($model, 'local_id')->hiddeninput(['value'=> $local])->label(false) ?>

<?= $form->field($model, 'convocatoria_id')->hiddeninput(['value'=> $convocatoria])->label(false)?>

<?= $form->field($model, 'usuario_id')->textInput() ?>

<?= $form->field($model, 'fecha_alta')->hiddeninput(['value'=>date("Y-m-d h:i:sa")])->label(false)?>
>>>>>>> Stashed changes

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end();?>

</div>
