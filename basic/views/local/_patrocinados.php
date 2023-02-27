<style>
.right {
    padding-top: 10px;
    padding-left: 10px;
    padding-right: 10px;
    margin-left: 10px;
    margin-right: 10px;
    position: relative;
    float: right;
    width:30%;
    border: steelblue solid 1px;
    height: auto;
}
</style>
<?php
/** @var yii\web\View $this */
use \app\models\Local;
use \app\models\Zonas;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = Yii::t('app', 'Patrocinados');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="right">

    <h1 class="text-center">Patrocinados</h1>
    <?php echo '<a href="'.Url::to(['local/index', 'prioridad' =>1]).'" class=" btn colorlogin mt-2" style=" margin-left:20% ;">Filtrar por prioridad</a>'?> 

    <div class="container">
        <div class="row">
            <?php
            foreach ($localespat as $local){
                echo $this->render('ficha_resumida', ['local'=>$local]);
            }
          ?>
        </div>
    </div>
</div>