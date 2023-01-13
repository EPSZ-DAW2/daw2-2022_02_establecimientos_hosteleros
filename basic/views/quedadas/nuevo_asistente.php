<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
?>
<html>
 <body>   
<h1>Nuevo Asistente</h1> 
 <?php $form = ActiveForm::begin(); ?>
   <?= $form->field($modelo, 'hidden1')->hiddenInput(['id'=> $modelo->id])?>
    <?= $form->field($modelo, 'usuario') ?>

    <div class="form-group">
        <?= Html::submitButton('agregar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
</body>
</html>