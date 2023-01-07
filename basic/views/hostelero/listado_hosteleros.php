<?php
/** @var yii\web\View $this */

use yii\bootstrap5\LinkPager;

$this->title = 'Listado Hosteleros';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Listado de hosteleros</h1>

<div class="container">
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="row">
		<?php
        if(empty($hosteleros)){
            echo '<h2>No se han encontrado hosteleros...</h2>';
        }else{
			foreach ($hosteleros as $hostelero){
				echo $this->render('ficha_resumida', ['hostelero'=>$hostelero]);
			}
        }
		?>
	</div>
</div>
<div style="margin-top: 2%">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
