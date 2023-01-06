<?php
/** @var yii\web\View $this */
?>
<h1>Listado de hosteleros</h1>

<div class="container">
    <div class="row">
		<?php
		foreach ($hosteleros as $hostelero){
			echo $this->render('ficha_resumida', ['hostelero'=>$hostelero]);
		}
		?>
    </div>
</div>
