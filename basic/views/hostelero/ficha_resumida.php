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
		<a href="<?= Url::toRoute(['local/index', 'id'=>$hostelero->id]);?>" class="card-link">Ver establecimientos publicados</a>
        <a href="<?= Url::toRoute(['hostelero/mensaje', 'id'=>$hostelero->id]); //CAMBIAR RUTA ACCIÓN?>" class="btn btn-success mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
            </svg>
            Enviar mensaje
        </a>
	</div>
</div>



