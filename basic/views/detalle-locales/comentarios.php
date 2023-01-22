<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
?> 
<html>
<body>   
<table>
    <?php
            $modeloComentarios = new LocalesComentarios();
            $comentarios = $modeloComentarios->listarcomentarios($info[0]['id']);
            
            if(empty($comentarios)){
                echo '<tr><td>No hay valoraciones de este local.</td></tr>';
            }else{
                foreach($comentarios as $comentario){
                    echo '<tr>';
                    foreach($comentario as $key => $value)
                    {
                        echo '<td >'.html::encode($value).'</td>';

                        /*$respuestas = $modeloComentarios->listarrespuestas($comentario['id']);
                        echo "****Respuestas";echo "</br>";
                        foreach($respuestas as $respuesta){
                            echo "</br>";
                            echo "*****Respuesta:";echo "</br>";
                            foreach($respuesta as $key => $value){
                                echo "******".$key." => ".$value;
                                echo "</br>";
                            }
                        }*///a respuestas le tengo que pasar el id del comentario
                    } ?> 
                        <td ><a href="<?= Url::toRoute(['detalle-locales/responder', 'id'=>$local->id]);?>" class="btn pl-2 pr-2 mb-0 btn-default">Responder</a></td>
                        <td ><a href="<?= Url::toRoute(['detalle-locales/respuestas', 'idComentario'=>$info[0]['id']]);?>" class="btn pl-2 pr-2 mb-0 btn-default">Respuestas</a></td>
                        <td ><?= Html::a("Denunciar", ['detalle-locales/denunciarcomentario', 'idLocal' => $info[0]['id'] ] , ['class' => 'btn btn-success']) ?></td>
                    </tr>
                    <?php
                }
            }
?> 
</table>
    <?= LinkPager::widget(['pagination' => $pagination]) 
    //boton ocultar comentarios?>
</body>  
</html>