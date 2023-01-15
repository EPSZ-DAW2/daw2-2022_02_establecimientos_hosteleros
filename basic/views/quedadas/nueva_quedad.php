<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
/* <th>Id</th>
  <th>Descripci&oacute;n</th>
  <th>Fecha inicio </th>
  <th>Fecha fin </th>
  <th> Estado Bloqueo </th>
  <th>Fecha de Bloqueo</th>
  <th>Nota Bloqueo </th>
  <th>Creador </th>
  <th>Fecha creación </th>
  <th> Ultima modificación</th>
 */
?>
<html>
 <body>    
<h1>Nueva Quedada</h1> 
 <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($modelo, 'descripcion') ?>
    <?= $form->field($modelo, 'fecha_inicio') ?>
    <?= $form->field($modelo, 'fecha_fin') ?>
    <?= $form->field($modelo, 'estado_bloqueo') ?>
    <?= $form->field($modelo, 'fecha_bloqueo') ?>
    <?= $form->field($modelo, 'nota_bloqueo') ?>
    <?= $form->field($modelo, 'creador') ?>
    <?= $form->field($modelo, 'fecha_creacion') ?>
    <div class="form-group">
        <?= Html::submitButton('agregar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
</body>
</html>