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
       echo '<td> <a href="<?= Url::toRoute(['quedadas/ficha_quedada', 'id'=>$modelo->id]);?>" ver</a> <a href="<?= Url::toRoute(['quedadas/asistencias', 'id'=>$modelo->id]);?>" ver asistencias</a>   <?php $form = ActiveForm::begin(['id' => 'borra-evento', 'method' => 'post',
       'action' => ['quedadas/borrar'],]);  ?><?= $form->field($model, 'hidden1')->hiddenInput(['id'=> $modelo->id])?> <?= Html::submitButton('borrar', ['class' => 'btn btn-primary',
       'name' => 'registration-button']);  ActiveForm::end(); ?> </td>';
       echo' </tr>';
    }

}
?> 
    </tbody> </table>
    </body>  
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </html>