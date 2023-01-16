<?php
//Ficha resumida de un local
use \app\models\Local;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var app\models\Local $local */
/** @var yii\widgets\ActiveForm $form */

?>
<div class="locales-mantenimiento-form">
    <?php $form = ActiveForm::begin([
        'action' => ['actualizar'],
        'method' => 'post',

    ]);?>
    <?= $form->field($local, 'titulo')->textarea(['rows' => 6]) ?>
    <?= $form->field($local, 'descripcion')->textarea(['rows' => 6]) ?>
    <?= $form->field($local, 'lugar')->textarea(['rows' => 6]) ?>
    <?= $form->field($local, 'url')->textarea(['rows' => 6]) ?>
    <?= $form->field($local, 'categoria_id')->textInput() ?>
    <?= $form->field($local, 'imagen_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($local, 'visible')->textInput() ?>
    <?= $form->field($local, 'cerrado_quedar')->textInput() ?>
    <?= $form->field($local, 'num_denuncias')->textInput(['value' =>$local->num_denuncias, 'readonly' => true])?>

    <?php if($local->bloqueado!=0){?>
        <p>Local bloqueado
        <?= $form->field($local, 'bloqueado')->textInput(['value' =>$local->bloqueado, 'readonly' => true])?>
    </p>
    <p>Fecha de bloqueo
        <?= $form->field($local, 'fecha_bloqueo')->textInput(['value' =>$local->fecha_bloqueo, 'readonly' => true])?></p>
    <p>Notas de bloqueo
        <?= $form->field($local, 'notas_bloqueo')->textInput(['value' =>$local->notas_bloqueo, 'readonly' => true]) ?></p>

    <?= $form->field($local, 'cerrado_comentar')->textInput() ?>
   <?php } ?>
    <?= $form->field($local, 'id')->hiddenInput() ?>
    <?= Html::submitButton(Yii::t('app', 'Guardar datos'), ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
</div>