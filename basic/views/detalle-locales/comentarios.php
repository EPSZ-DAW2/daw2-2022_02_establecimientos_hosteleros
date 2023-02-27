<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use app\models\LocalesComentarios;
use app\models\Usuario;
use yii\data\Pagination;
use yii\db\ActiveRecord;

?> 

<style>
  details[open] > div {
    padding-left: 5%;
  }
</style>

<html>
<body>   
  <?php
    $modeloComentarios = new LocalesComentarios();
    //$comentarios = $modeloComentarios->listarcomentarios($local_id);
    echo '<div class="container" style="margin-left:0.6%;background-color:#e1e1e1;border: 1px solid grey;box-shadow: 1px 2px 6px black;border-radius:15px;padding-left:2%;padding-top:2%">';
    if(empty($comentarios)){
      echo '<div class="row" style="border-bottom:1px solid grey"><div class="col">No hay valoraciones de este local.</div></div></div>';
    } else {
      foreach($comentarios as $comentario){ /* Foreach comentarios */
        echo '<div class="row" >';
        $comentario_id=null;
        foreach($comentario as $key => $value) /* Foreach contenido de comentarios y denuncia de comentarios */
        {
          //echo $key.'=>'.$value.'</br>';
          if($key=='id'){
            $comentario_id = $value;
          }
          if($key ==='valoracion'){
            echo '<div class="col">Nota:'.html::encode($value).'</div>';
          }
          if($key ==='texto'){
            echo '<div class="col">'.html::encode($value).'</div>';
          }
          if($key ==='crea_fecha'){
            echo '<div class="col">'.html::encode($value).'</div>';
          }
        }
          if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)||Usuario::esRolSistema($idUsuario))
          {
            ?> 
            <div class="col" ><?= Html::a("Denunciar", ['detalle-locales/denunciarcomentario', 'idComentario' => $comentario['id']] , ['class' => 'btn btn-outline-danger']) ?>
            </div><!-- col -->
            <?php 
          } 
            ?>
          </div><!-- row -->
          <div class="row" style="border-bottom:1px solid grey"> <!-- Responder y respuestas a comentarios -->
          <div class="col">
            <?php 
              if($modeloComentarios->esCerrado($comentario_id)==0){
                if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){ ?>
                  <details><summary>Responder</summary>
                    <div>
                      <?php echo $this->render('_responder', ['idComentario'=>$comentario['id'],'local_id'=>$local_id, 'idUsuario'=>$idUsuario]);?>
                    </div>
                  </details>
                  <?php 
                } 
                  ?>
                <details><summary>Respuestas</summary>
                  <div>
                    <?php echo $this->render('_respuestas', ['idComentario' => $comentario['id'],'local_id'=>$local_id,'idUsuario'=>$idUsuario]); ?>
                  </div>
                </details>
                <?php 
              }
                ?>
          </div><!-- col -->
        </div><!--row -->
        </br>
        <?php
      }
    }
        ?> 
    </div><!--container -->
    <?php echo yii\widgets\LinkPager::widget([
              'pagination' => $pages,
              'hideOnSinglePage' => true,
              'activePageCssClass' => 'active-page ' ,
              'maxButtonCount' => 5 ,
              'pageCssClass' => 'page-item ' ,
              'linkOptions' => [
                  'class'=>'page-link'
                ],
              'options' => [
                  'class' => 'pagination pagination-sm'
              ]
      ]);?>

  </body>  
  </html>