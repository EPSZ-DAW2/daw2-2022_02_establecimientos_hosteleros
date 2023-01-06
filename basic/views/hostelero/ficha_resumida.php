<?php
//Ficha resumida de hosteleros

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="card mx-3 my-3" style="width: 18rem;">
	<div class="card-body">
        <?php if(isset($hostelero->razon_social) || $hostelero->razon_social != ""):?>
		    <h5 class="card-title"><?= Html::encode("{$hostelero->razon_social}")?></h5>
        <?php else:
            $usuario=$hostelero->getUsuario()->one();
            $nombreApellidos=$usuario->nombre." ".$usuario->apellidos;
        ?>
            <h5 class="card-title"><?= Html::encode("{$nombreApellidos}")?></h5>
        <?php endif; ?>
		<h6 class="card-subtitle mb-2 text-muted">Cifnif: <?= Html::encode("{$hostelero->nif_cif}")?></h6>

		<?php if(isset($hostelero->url) || $hostelero->url != ""): ?>
		<p class="card-text">Web comercio: <a href="<?= Html::encode("{$hostelero->url}")?>" target="_blank">Visita la web</a></p>
        <?php else:?>
            <p class="card-text">Web comercio: Aún no hay nada por aquí...</p>
		<?php endif; ?>
        <p class="card-text">Teléfono de contacto: <?= Html::encode("{$hostelero->telefono_contacto}")?></p>
		<a href="<?= Url::toRoute(['hostelero/detalle', 'id'=>$hostelero->id]);?>" class="card-link">Mas información</a>
	</div>
</div>


