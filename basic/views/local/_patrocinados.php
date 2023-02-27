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

$this->title = Yii::t('app', 'Patrocinados');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="right">

    <h1 class="text-center">Patrocinados</h1>

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