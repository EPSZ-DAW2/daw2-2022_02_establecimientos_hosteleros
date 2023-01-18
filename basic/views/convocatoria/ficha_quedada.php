<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use app\models\Local;
use app\models\Asistente;

?>
<div class="card mx-3 my-3 info" style="width: 18rem;">
  
  <div>
    <?php
      //cargo los datos del local asociado solo una vez para no saturar la base de datos
      //$local->setAttributes($convocatoria->getLocal()->one());
      $local=$convocatoria->local;
      //si no encuentra el local
      if($local != null){

        $local=$convocatoria->local;
        //var_dump($local->attributes);
        //$foto_id= 1;
        //$local_nombre="a";
        $foto_id= $local->attributes["imagen_id"];
        $local_nombre=$local->attributes["titulo"];
      } else {
        $local=$convocatoria->local;
        $foto_id= "none";
        $local_nombre="Nombre no obtenido";
      }

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
    <?php
      $inicio = date_create($convocatoria->fecha_desde);      
      $fin = new DateTime($convocatoria->fecha_hasta);
      $inicioaux= date_format($inicio,'Y-m-d');
      $finaux = $fin->format('Y-m-d');
    ?>
      <h5><?= html::encode("{$convocatoria->texto}")?></h5>
      <br/>
      <h6><?= html::encode("{$inicioaux}")?> - <?= html::encode("{$finaux}")?></h6>
      <br/>
      <?php
      $inicioaux= date_format($inicio,'H:i:s');
      //var_dump($inicio);

      $finaux = $fin->format('H:i:s');
      //var_dump($fin);
      ?>
      <h6>Hora de inicio: <?= html::encode("{$inicioaux}")?></h6>
      <h6>Hora de cierre: <?= html::encode("{$finaux}")?></h6>
      <br/>
      <h6>Local: <?=html::encode("{$local_nombre}")?></h6>

      <?php
        //si está logueado le saldan las opciones de reportar e incribirse
        if(!Yii::$app->user->isGuest){
          //Incriovorse
          $id_asistente =Yii::$app->user->id;
          $asistente= Asistente::findOne(['convocatoria_id' => $convocatoria->id ,'usuario_id' => $id_asistente ]);
          if (!empty($asistente)) {
            //echo"bb";
            echo (html::a('desinscribir', Url::toRoute(["desinscribir", 'id' => $convocatoria->id]),['class' => 'btn btn-danger']));
          } else {
            //echo"cc";
            echo (html::a('inscribir',Url::toRoute(["inscribir", 'id' => $convocatoria->id]),['class' => 'btn btn-success']));
          } 

          //reportar

          if( !(isset($_SESSION['REPORT_VECES']) && $_SESSION['REPORT_VECES']!=0)){
              echo (Html::a('reportar',Url::toRoute(["reportar", 'id' => $convocatoria->id]),['class' => 'btn btn-danger']));
          } else {
            'Superado el límite de reportes';
          }
        }
      ?>
    </div>
  
</div>