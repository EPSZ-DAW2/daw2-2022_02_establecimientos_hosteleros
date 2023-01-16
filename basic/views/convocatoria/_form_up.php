<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */
/** @var yii\widgets\ActiveForm $form */
$timestamp = time()-(60*60*4);
?>

<div class="convocatoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'local_id')->textInput() ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_desde')->textInput() ?>

    <?= $form->field($model, 'fecha_hasta')->textInput() ?>

    <?= $form->field($model, 'num_denuncias')->textInput() ?>
    
    <?= $form->field($model, 'fecha_denuncia1')->textInput() ?>

    <?= $form->field($model, 'bloqueada')->textInput() ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

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
