<?php
use yii\helpers\Html;
use yii\helpers\CHtml;
use yii\helpers\Url;
use app\models\UsuariosLocales;
use app\models\Usuario;
use app\models\LocalesComentarios;
use yii\web\Session;
use yii\bootstrap5\ActiveForm;
use app\controllers\CPagination;
use yii\db\ActiveRecord;

/** @var yii\web\View $this */

$this->title = $info[0]['titulo'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
  <div class="row justify-content-between"> <!-- Titulo, datos y boton seguir -->
    <div class="col-7 d-flex">
      <div class="col">
        <div class="col-12 d-flex justify-content-between">
            <?php
              $idUsuario = Yii::$app->session->get('__id');
              echo "<h2>".$info[0]['titulo']."</h2>";
              if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)||Usuario::esRolSistema($idUsuario)){
                $modeloUsuLocales = new UsuariosLocales();
                $retorno = $modeloUsuLocales->comprobarSeguimiento($idUsuario, $info[0]['id']);
                if($retorno === true){
                  //Mostrar boton de dejar de seguir
                  ?>
                    <?= Html::a("Dejar de seguir", ['detalle-locales/unfollow','usuario_id'=>$idUsuario, 'local_id'=>$info[0]['id']], ['class' => 'btn btn-danger']);?>
                  <?php
                } elseif ($retorno === false) {
                  //Mostrar boton de seguir
                  ?>
                    <?= Html::a("Seguir", ['detalle-locales/follow','usuario_id'=>$idUsuario, 'local_id'=>$info[0]['id']], ['class' => 'btn btn-success']);?>
                  <?php
                }
              }
            ?>
        </div>
        <?php
          echo "<p><h5 class='d-inline'>Calificación: ".round($mediaVal,1)."/5</h5></p>";
          echo "<p>".$info[0]['descripcion']."</p>";
          echo "<p><h5 class='d-inline'>Dirección: ".$info[0]['lugar']."</h5></p>";
          echo "<p><h5 class='d-inline'>URL: <a target='_blank' href='".$info[0]['url']."'>".$info[0]['url']."</a></h5></p>";
        ?>
        <?= Html::a("Quedadas", ['convocatoria/index'] , ['class' => 'btn pl-2 pr-2 mb-0 btn-default']) ?></br>
      </div>

      
    </div>

    <div class="col-5 d-flex align-items-end flex-column mb-3">
      <img src="<?php echo Url::to("@web/uploadimages/".$info[0]['imagen_id'].'.jpg')?>" alt="Imagen" width="100%" height="85%">      
      <?php
        if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){?>
          <?=Html::a("Denunciar local", ['detalle-locales/denunciarlocal', 'idLocal' => $info[0]['id'] ] , ['class' => 'btn btn-danger mt-auto p-2', 'type'=>'button']);?>
      <?php
        }
      ?>
    </div>
  </div>

  <div class="row">
    <?php if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){ ?>
    <div class="row" style="margin-bottom:25px;margin-left:0.5%;margin-right:1%; background-color:#e2e2e2;border: 1px solid black;box-shadow: 1px 2px 6px black;border-radius:15px;"> <!-- Comentar local -->
      <?php
          $form = ActiveForm::begin(['action' =>['detalle-locales/comentar'], 'id' => 'detalle-locales', 'method' => 'post',]); 
            $model = new LocalesComentarios();?>
              <div class="row"> <!-- Formulario comentario local -->
                <div class="col-4">
                  <p class="clasificacion">
                      <?= $form->field($model, 'local_id')->hiddenInput(array('value'=>$info[0]['id']))->label(false) ?>
                      <?= $form->field($model, 'crea_usuario_id')->hiddenInput(array('value'=>$idUsuario))->label(false) ?>
                      <?= $form->field($model, 'comentario_id')->hiddenInput(array('value'=>0))->label(false) ?>
                      <?= $form->field($model, 'valoracion')->inline()->radioList(['1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5])->label("Valoración");?>
                  </p>
                </div>
                <div class="col-8 d-flex align-items-end justify-content-left">
                  <?= $form->field($model, 'cerrado')->checkbox(['value' => 1])->label('Comentario cerrado'); ?>
                </div>
              </div>

              <div class="row justify-content-between"> <!-- Texto y enviar comentario a local -->
                <div class="col-xl-10">
                  <?=$form->field($model, 'texto')->textInput()?>
                </div>
                <div class="col-md-auto d-flex align-items-end justify-content-end" style="margin-bottom:19px;">
                  <?= Html::submitButton('Valorar', ['class' => 'btn pl-2 pr-2 mb-0 btn-default']) ?>
                </div>
              </div>
    </div>
    <div class="col" style="padding:0px">
      <div class="d-flex flex-column align-items-center justify-content-center" style="background-color:none !important;"> <!-- Comentarios del local -->
        <?php ActiveForm::end();
        }
        $idLocal=$info[0]['id'];
          
        echo $this->render('comentarios',['idUsuario'=>$idUsuario, 'local_id'=>$idLocal, 'pages'=>$pages, 'comentarios'=>$models]);
        ?>
      </div>
    </div>
  </div>
</div>