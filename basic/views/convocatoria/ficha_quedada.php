<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
?>
<div class="card mx-3 my-3 info" style="width: 18rem;">
  
  <div>
    <?php
      //cargo los datos del local asociado solo una vez para no saturar la base de datos
      $foto_id=$convocatoria->localFoto_Id;
    ?>
      <?php //Poner la url de donde se guarda la foto
      
      if(isset($foto_id) && $foto_id!=''): ?>
          <?php if(file_exists('uploadimages/'.$foto_id.'.jpg') || file_exists('uploadimages/'.$foto_id.'.png')): ?>
              <img src="uploadimages/<?= $foto_id?>.jpg" class="img-fluid" style="width: 100%; height: 15rem"/>
  <?php else:?>
              <img src="images/sinfoto.jpg" class="img-fluid" style="width: 100%; height: 15rem" />
  <?php endif; ?>
      <?php else:?>
          <img src="images/sinfoto.jpg" class="img-fluid" style="width: 100%; height: 15rem" />
      <?php endif; ?>
  </div>

  <p></p>

  <div class="card-body">
      <h5><?= html::encode("{$convocatoria->texto}")?></h5>
      <br/>
      <h6><?= date(html::encode('d-m-Y',"{$convocatoria->fecha_desde}"))?> - <?= date(html::encode('d-m-Y',"{$convocatoria->fecha_hasta}"))?></h6>
      <br/>
      <h6>Hora de inicio: <?= date(html::encode('h:i',"{$convocatoria->fecha_desde}"))?></h6>
      <h6>Hora de cierre: <?= date(html::encode('h:i',"{$convocatoria->fecha_hasta}"))?></h6>
      <br/>
      <h6>Local: <?=html::encode("{$convocatoria->localNombre}")?></h6>
    </div>
  
</div>