<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\UsuariosLocales;
use yii\web\Session;
/** @var yii\web\View $this */

$this->title = $info[0]['titulo'];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="mx-3 my-3" style="max-width: 23rem;">
    <div class="card-body">

        <img src="<?php echo Url::to("@web/uploadimages/".$info[0]['imagen_id'].'.jpg')?>" alt="Imagen" class="img-fluid">
        <?php
            foreach($info[0] as $key => $valor){
                echo $key . "->" . $valor;
                echo "</br>";
            }
            '</br>';echo $mediaVal;'</br>';//echo $comentarios;
            $idUsuario = Yii::$app->session->get('__id');
            echo '</br>';
            echo "idUsuario: ".$idUsuario;
        ?>
        <div class="d-flex justify-content-center">
            <?php
            
            //if(UsuariosLocales::comprobarSeguimiento($idUsuario, ))
            //Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) 
           
            ?>
            <!--<a href="<?php// Url::toRoute(['detalle-locales/index', 'idLocal'=>$local->id]);?>" class="btn pl-2 pr-2 mb-0 btn-default">Saber más</a>-->
            
        </div>

        <?php //Html::a("Denunciar local", ['controller/denunciarLocal'], ['class' => 'btn btn-success']) ?>
    </div>
</section>