<?php

use app\models\Convocatoria;
use app\models\Asistente;

//use Yii;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use yii\bootstrap5\LinkPager;

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

/** @var yii\web\View $this */
/** @var app\models\ConvocatoriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Convocatorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<?php 
    /*echo "<pre>"; 
    var_dump( $convocatorias);
    echo "</pre>";*/
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        include('menu.php');
?>
    <details>
        <summary>Filtros</summary>
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </details>

    <div class="row">
        <?php
            if(empty($convocatorias)){
                echo '<h2>No hay convocatorias activas</h2>';
            }else{
                foreach ($convocatorias as $convocatoria){
                    echo $this->render('ficha_quedada', ['convocatoria'=>$convocatoria]);
                }
            }
		?>
    </div>
</div>

<div style="margin-top: 2%">
	<?= LinkPager::widget(['pagination' => $pagination]); /*echo "<pre>"; var_dump( $pagination);echo "</pre>";*/  ?>
</div>
