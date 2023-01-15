<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UserAgent;

/** @var yii\web\View $this */
/** @var app\models\Registro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registro-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'fecha_registro')->textInput(['value' => date('Y-m-d H:i:s'), 'readonly' => true]) ?>

    <?= $form->field($model, 'clase_log_id')->dropDownList( \app\models\Registro::listaEstados()) ?>
    <?= $form->field($model, 'modulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?php $userIP = Yii::$app->request->userIP;?>
    <?= $form->field($model, 'ip')->textInput(['value' =>$userIP ,'maxlength' => true]) ?>
    <?php
    //$userAgent = Yii::$app->request->getUserAgent();
    //$browserName = $userAgent->getBrowser();


    ?>
    <?= $form->field($model, 'browser')->textInput(['value' => $model->get_browser_name($_SERVER['HTTP_USER_AGENT'])]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
