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

        if (isset($model->clase_zona_id) && ($model->clase_zona_id != null) ){

            //Si el padre no existe
            if ($model->padre == null)
                echo Html::tag('div', 'El padre escogido no existe',['class' => 'error-summary']);
            //Si el padre elegido tiene un tipo de zona de menor categoría
            else if ($model->clase_zona_id < $model->padre->clase_zona_id )
                echo Html::tag('div', 'El padre escogido es de un rango igual o inferior',['class' => 'error-summary']);
            
           
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
