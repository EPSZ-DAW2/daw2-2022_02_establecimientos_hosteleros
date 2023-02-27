<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/** @var yii\web\View $this */
/** @var app\models\Zonas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="zonas-form">
    
    <?php $form = ActiveForm::begin(); ?>
    <?php 
    
    //Comprobación de errores si ya se ha validado pero ha vuelto al form
        $error = $model->ComprobarDatos();
        if (is_string($model->ComprobarDatos())){ //Si el formulario no está vacío
            echo Html::tag('div', $error,['class' => 'error-summary']);               
        }
        //echo("a");
    
    ?>
    <?= $form->field($model, 'clase_zona_id')->dropDownList( \app\models\Zonas::listaZonas()) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
