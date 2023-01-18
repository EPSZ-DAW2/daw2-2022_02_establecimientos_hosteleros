<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="convocatoria-form">
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'local_id')->hiddenInput([ 'value' => $model->id])->label(false) ?>

<?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'fecha_desde')->textInput() ?>

<?= $form->field($model, 'fecha_hasta')->textInput() ?>

<?= $form->field($model, 'num_denuncias')->hiddenInput([ 'value' => $model->num_denuncias])->label(false) ?>

<?= $form->field($model, 'bloqueada')->textInput() ?>
<?php if($model->bloqueada==1){?>

<?= $form->field($model, 'fecha_bloqueo')->hiddenInput([ 'value' => date('Y-m-d H:i:s') ])->label(false) ?>
<?php }else{?>
    <?= $form->field($model, 'fecha_bloqueo')->hiddenInput([ 'value' =>NULL ])->label(false) ?>
    <?php }?>
<?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

<?php //$form->field($model, 'modi_usuario_id')->textInput() ?>
<?= $form->field($model, 'modi_usuario_id')->hiddenInput([ 'value' =>0])->label(false) ?>

<?php //$form->field($model, 'modi_fecha')->textInput() ?>
<?= $form->field($model, 'modi_fecha')->hiddenInput([ 'value' => date('Y-m-d H:i:s') ])->label(false) ?>

</br>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>