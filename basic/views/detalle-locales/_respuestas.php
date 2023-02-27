<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use app\models\LocalesComentarios;
use app\models\Usuario;

?> 


<html>
<body>   

    <?php
            $modeloComentarios = new LocalesComentarios();
            $comentarios = $modeloComentarios->listarrespuestas($idComentario);
            
            if(empty($comentarios)){
                echo '<div class="container"><div class="row"><div class="col">No hay respuestas a este comentario.</div></div></div>';
            }else{
                foreach($comentarios as $comentario){
                    echo '<div class="container"><div class="row">';
                    $comentario_id=null;
                    foreach($comentario as $key => $value)
                    {
                        if($key=='id'){
                            $comentario_id = $value;
                        }
                        if($key != 'id'){    
                            if($key != 'valoracion'){                          
                                echo '<div class="col">'.html::encode($value).'</div>';
                            }
                        }
                    } 
                    
                    if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){ ?> 
                        <div class="col"><?= Html::a("Denunciar", ['detalle-locales/denunciarcomentario', 'idLocal' =>$comentario['id'] ] , ['class' => 'btn btn-outline-danger']) ?></td>
                        </div><!-- col -->
                        <?php } ?>
                        </div><!-- row -->
                        <div class="row">
                        <div class="col">
                            <?php 
                            if($modeloComentarios->esCerrado($comentario_id)==0){
                                if(Usuario::esRolNormal($idUsuario) || Usuario::esRolModerador($idUsuario)||Usuario::esRolPatrocinador($idUsuario)||Usuario::esRolAdmin($idUsuario)){ ?>
                                    <details><summary>Responder</summary>
                                        <div>
                                            <?php echo $this->render('_responder', ['idComentario'=>$comentario['id'],'local_id'=>$local_id, 'idUsuario'=>$idUsuario]);?>
                                        </div>
                                    </details>
                                <?php } ?>
                                    <details><summary>Respuestas</summary>
                                        <div>
                                            <?php echo $this->render('_respuestas', ['idComentario' => $comentario['id'],'local_id'=>$local_id,'idUsuario'=>$idUsuario]);  ?>
                                        </div>
                                    </details>
                                <?php } ?>
                        </div><!-- col -->
                        </div><!--row -->
                        </div><!--container -->
                    <?php 
                }
            }


    ?> 

</body>  
</html>