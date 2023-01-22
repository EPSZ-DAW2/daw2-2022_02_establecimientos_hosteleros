<?php
use yii\helpers\Html;
use yii\helpers\CHtml;
use yii\helpers\Url;
use app\models\UsuariosLocales;
use app\models\Usuario;
use app\models\LocalesComentarios;
use yii\web\Session;
use yii\bootstrap5\ActiveForm;
/** @var yii\web\View $this */

$this->title = $info[0]['titulo'];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="mx-3 my-3" style="max-width: 23rem;">
    <div class="card">

       
        <?php
            $idUsuario = Yii::$app->session->get('__id');
            echo $info[0]['titulo'];echo "</br>";
            echo $info[0]['descripcion'];echo "</br>";
            echo $info[0]['lugar'];echo "</br>";
            echo $info[0]['url'];echo "</br>";
            if( Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){
                //echo cositas que solo ven los admin y esa gente
            }
            echo $mediaVal;echo "</br>";

            
        ?>
    
        <div class="card-img">
         <img src="<?php echo Url::to("@web/uploadimages/".$info[0]['imagen_id'].'.jpg')?>" alt="Imagen" class="img-fluid">
            <?php
            if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){
                $modeloUsuLocales = new UsuariosLocales();
                $retorno = $modeloUsuLocales->comprobarSeguimiento($idUsuario, $info[0]['id']);
                if($retorno === true){
                    //Mostrar boton de dejar de seguir
                    ?>
                    <?= Html::a("Dejar de seguir", ['detalle-locales/unfollow','usuario_id'=>$idUsuario, 'local_id'=>$info[0]['id']], ['class' => 'btn btn-primary']);?>
                    <?php
                } elseif ($retorno === false) {
                    ?>
                    <?= Html::a("Seguir", ['detalle-locales/follow','usuario_id'=>$idUsuario, 'local_id'=>$info[0]['id']], ['class' => 'btn btn-primary']);?>
                    <?php
                    //Mostrar boton de seguir
                }
            }
            ?>
            <!--<a href="<?php// Url::toRoute(['detalle-locales/index', 'idLocal'=>$local->id]);?>" class="btn pl-2 pr-2 mb-0 btn-default">Saber más</a>-->
            
        </div>        
        <?php
        if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){?>
          <?=Html::a("Denunciar local", ['detalle-locales/denunciarlocal', 'idLocal' => $info[0]['id'] ] , ['class' => 'btn btn-success']);?>
          <?php
        }
        ?>
        <?= Html::a("Quedadas", ['convocatoria/index'] , ['class' => 'btn btn-success']) ?>
        <div class="d-flex justify-content-center">
        <?php
        if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){
         $form = ActiveForm::begin(); 
            $model = new LocalesComentarios();?>
            
            <div class="form-group">
                <p class="clasificacion">

                    <?= $form->field($model, 'valoracion')->inline()->radioList(['1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5]);?>
                </p>
                <?=$form->field($model, 'texto')->textInput()?>
                <div>
                    <?= $form->field($model, 'cerrado')->checkbox(['value' => 1])->label('Comentario cerrado'); ?>
                    <!--<input type="checkbox" id="cerrado" name="cerrado" value=1★>
                    <label for="cerrado">Comentario cerrado</label>-->
                </div>
                <?= Html::submitButton('Valorar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end();
        }
        $idLocal=$info[0]['id'];
        if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){
          echo $this->render('comentarios',['usuario_id'=>$idUsuario, 'local_id'=>$idLocal]);
        
        }

        ?>
        
    </div>
</section>
<!-- codigo css para las estrellas que no se donde ponerlo
#form {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#form p {
  text-align: center;
}

#form label {
  font-size: 20px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}-->