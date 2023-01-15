<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
?>
<html>
 <body>   
<h1>Asistencia</h1>
<table>
<thead>
<tr>
  <th>Id Local</th>
  <th>Asistente</th>
  <th>Fecha alta</th>
  <th>Acciones</th>
</tr>
</thead>
<tbody>
<?php $modelo = new Convocatoria_Asistencia();

  if(empty($registros)){
    echo '<h2>No hay convocatorias existentes</h2>';
}else{
    foreach ($registros as $indice=>$registro){
       echo' <tr>';
       $modelo->llenar($registro);
       echo '<td >'.html::encode( $modelo->id).'</td>';
       echo '<td >'.html::encode( $modelo->$usuario_id).'</td>';
       echo '<td >'.html::encode( $modelo->fecha_alta).'</td>';
       echo '<td>  <?php $form = ActiveForm::begin(['id' => 'borra-evento', 'method' => 'post',
       'action' => ['quedadas/borrar'],]);  ?><?= $form->field($model, 'hidden1')->hiddenInput(['id'=> $modelo->id)])?> <?= Html::submitButton('borrar', ['class' => 'btn btn-primary',
       'name' => 'registration-button']);  ActiveForm::end(); ?> </td>';
       echo' </tr>';
    }
    echo Button::widget([
        'nuevo' => 'nuevo_asistente.php',
        'options' => ['class' => 'btn-lg'],
    ]);
}   
        
?> 
    </tbody> </table>
    </body>  
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </html>