<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarioaviso $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="usuarioaviso-form">

    <?php  $form = ActiveForm::begin(); ?>




    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'nombreUsuarioInv')->textInput()?>
    <?= $form->field($model, 'nombreLocalInv')->textInput()?>

    <div class="form-group">
        <?php if (isset($msgError)): ?>
            <div class="alert alert-danger">
                <?= $msgError ?>
            </div>
        <?php endif; ?>
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
