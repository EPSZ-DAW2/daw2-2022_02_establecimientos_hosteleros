<?php 

/* @var $this yii\web\View */
use app\commands\Backup;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
 $i=0;
?>


<h1 style="margin-bottom:2%;margin-top:6%;margin-left:7%">Copias de seguridad</h1>

<?php echo '<a href="'.Url::to(['backup/copia', 'btn' =>'si']).'" class=" btn colorlogin mt-2" style=" margin-left:7% ;margin-right:75%">Hacer copia</a>'?> </td>
<table  style="margin-top:4%;margin-left:8%;"class="table table-hover">
<?php     while (($archivo = readdir($model)) !== false)  {?>
<?php      if ($archivo != "." && $archivo != "..") { $i++?>
                 
                 <tr><td>
                <?php 
             
              
                    // Si es un directorio se recorre recursivamente
                    
                        echo "" . $archivo . "";?> </td><td><?php $form = ActiveForm::begin([
                            'action' => ['restaurar'],
                            'method' => 'get',
                        ]); ?>
                    
                    <?php echo '<a href="'.Url::to(['backup/restaurar', 'archivo' =>$archivo]).'" class="btn pl-2 pr-2 mb-0 btn-default">restaurar copia</a>'?> </td><?php
                  
                } }
                
            ?>
            </tr>
            </table>
            <?php  $pagination = new Pagination(['totalCount' => $i, 'pageSize'=>10]);

echo \yii\widgets\LinkPager::widget([
    'pagination' => $pagination,
]);?>