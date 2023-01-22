<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */
/** @var yii\widgets\ActiveForm $form */
$timestamp = time()-(60*60*4);

//modelo locales

//buscamos todos los locales disponibles y guardamos id y nombre

?>

<div class="convocatoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'local_id')->textInput() ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_solo_inicio')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
        ])->label("Fecha de inicio") ?>

    <?= $form->field($model, 'fecha_solo_fin')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
        ])->label("Fecha de finalización") ?>

    <?= $form->field($model, 'hora_solo_inicio')->textInput()->label("Hora de inicio") ?>
    <?= $form->field($model, 'hora_solo_fin') ->textInput()->label("Hora de finalización")?>

    <?php //$form->field($model, 'num_denuncias')->textInput() ?>
    <?= $form->field($model, 'num_denuncias')->hiddenInput([ 'value' => 0 ])->label(false) ?>
    <?php //$form->field($model, 'fecha_denuncia1')->textInput() ?>

    <?php //form->field($model, 'bloqueada')->textInput() ?>

    <?php //$form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?php //$form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'crea_usuario_id')->textInput() ?>
    <?= $form->field($model, 'crea_usuario_id')->hiddenInput([ 'value' => Yii::$app->user->id ])->label(false) ?>

    <?php //$form->field($model, 'crea_fecha')->textInput() ?>
    <?= $form->field($model, 'crea_fecha')->hiddenInput([ 'value' => date('Y-m-d H:i:s',$timestamp) ])->label(false) ?>

    <?php //$form->field($model, 'modi_usuario_id')->textInput() ?>
    <?= $form->field($model, 'modi_usuario_id')->hiddenInput([ 'value' => Yii::$app->user->id ])->label(false) ?>
    <?php //$form->field($model, 'modi_fecha')->textInput() ?>
    <?= $form->field($model, 'modi_fecha')->hiddenInput([ 'value' => date('Y-m-d H:i:s',$timestamp) ])->label(false) ?>
    </br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
