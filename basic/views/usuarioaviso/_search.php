<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UsuarioavisoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarioaviso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //= $form->field($model, 'id') ?>

    <?=$form->field($model, 'fecha_aviso')->widget(\yii\jui\DatePicker::classname(), [
         'language' => 'es',
         'dateFormat' => 'yyyy-MM-dd',
     ])?>

    <?= $form->field($model, 'clase_aviso_id')->dropDownList( \app\models\Usuarioaviso::listaAvisos()) ?>

    <?php //= $form->field($model, 'texto') ?>

    <?php //= $form->field($model, 'destino_usuario_id') ?>

    <?php // echo $form->field($model, 'origen_usuario_id') ?>

    <?php // echo $form->field($model, 'local_id') ?>

    <?php // echo $form->field($model, 'comentario_id') ?>

    <?php // echo $form->field($model, 'fecha_lectura') ?>

    <?php // echo $form->field($model, 'fecha_aceptado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
