<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
?>
<html>
 <body>   
<h1>Quedadas / Convocatorias</h1>
<table>
<thead>
<tr>
  <th>Id</th>
  <th>Descripci&oacute;n</th>
  <th>Estado</th>
  <th>Acciones</th>
</tr>
</thead>
<tbody>
<?php $modelo = new Convocatoria();

  if(empty($registros)){
    echo '<h2>No hay convocatorias existentes</h2>';
}else{
    foreach ($registros as $indice=>$registro){
       echo' <tr>';
       $modelo->llenar($registro);
       echo '<td >'.html::encode( $modelo->id).'</td>';
       echo '<td >'.html::encode( $modelo->texto).'</td>';
       echo '<td >'.html::encode( $modelo->bloqueado).'</td>';
       echo '<td> <a href="<?= Url::toRoute(['quedadas/denunciar', 'id'=>$modelo->id]);?>">Denunciar</a>  <?php $form = ActiveForm::begin(['id' => 'asistir', 'method' => 'post',
       'action' => ['quedadas/asistir'],]);  ?> <?= $form->field($model, 'hidden1')->hiddenInput(['id'=> $modelo->id])?> <?= Html::submitButton('quiero asistir', ['class' => 'btn btn-primary',
       'name' => 'registration-button']);  ActiveForm::end(); ?>   <?php $form = ActiveForm::begin(['id' => 'borra-asistir', 'method' => 'post',
       'action' => ['quedadas/borrar_asistir'],]);  ?><?= $form->field($model, 'hidden1')->hiddenInput(['id'=> $modelo->id])?> <?= Html::submitButton('no voy a asistir', ['class' => 'btn btn-primary',
       'name' => 'registration-button']);  ActiveForm::end(); ?> </td>';
    }

}
?> 
    </tbody> </table>
    </body>  
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </html>