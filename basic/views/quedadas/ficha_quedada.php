<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
?>
<html>
 <body>   
<h1>Quedada</h1>
<table>
<thead>
<tr>
  <th>Id</th>
  <th>Descripci&oacute;n</th>
  <th>Fecha inicio </th>
  <th>Fecha fin </th>
  <th>Num de denuncias</th>
  <th>Fecha de denuncia </th>
  <th> Estado Bloqueo </th>
  <th>Fecha de Bloqueo</th>
  <th>Nota Bloqueo </th>
  <th>Creador </th>
  <th>Fecha creación </th>
  <th> Ultima modificación</th>
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
       echo '<td >'.html::encode( $modelo->fecha_desde).'</td>';
       echo '<td >'.html::encode( $modelo->fecha_hasta).'</td>';
       echo '<td >'.html::encode( $modelo->num_denuncias).'</td>';
       echo '<td >'.html::encode( $modelo->fecha_denuncia).'</td>';
       echo '<td >'.html::encode( $modelo->bloqueada).'</td>';
       echo '<td >'.html::encode( $modelo->fecha_bloqueo).'</td>';
       echo '<td >'.html::encode( $modelo->notas_bloqueo).'</td>';
       echo '<td >'.html::encode( $modelo->crea_usuario_id).'</td>';
       echo '<td >'.html::encode( $modelo->crea_fecha).'</td>';
       echo '<td >'.html::encode( $modelo->modi_usuario_id).','.html::encode( $modelo->modi_fecha).'</td>';
       echo '<td> <a href="<?= Url::toRoute(['quedadas/editar_quedada', 'id'=>$modelo->id]);?>"> editar</a></td>';
       echo' </tr>';
    }

}
?> 
    </tbody> </table>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </body>  
    </html>