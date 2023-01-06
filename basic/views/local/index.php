<?php
/** @var yii\web\View $this */
?>
<h1>Listado de locales</h1>

<div class="container">
    <div class="row">
		<?php
        foreach ($locales as $local){
            echo $this->render('ficha_resumida', ['local'=>$local]);
        }
        ?>
    </div>
</div>
