<?php
//Ficha resumida de un local
use \app\models\Local;
use yii\helpers\Url;
use yii\helpers\Html; ?>

<section class="mx-3 my-3" style="max-width: 23rem;">

    <div class="card">
        <div>
            <?php //Poner la url de donde se guarda la foto?>
            <img src="https://images.pexels.com/photos/67468/pexels-photo-67468.jpeg?auto=compress&cs=tinysrgb&w=1600" class="img-fluid" />
        </div>
        <div class="card-body">
            <h5 class="card-title font-weight-bold"><a><?= Html::encode("{$local->titulo}")?></a></h5>
            <ul class="list-unstyled list-inline mb-0">
                <li class="list-inline-item">
                    <?php
                        if($local->sumaValores/$local->totalVotos != null || $local->sumaValores/$local->totalVotos != 0)
                            $valoracion=$local->sumaValores/$local->totalVotos;
                        else
                            $valoracion="Sin valoraciones";
                    ?>
                    <p class="text-muted"><?= Html::encode("{$valoracion}")?> (<?= Html::encode("{$local->totalVotos}")?>)</p>
                </li>
                <li class="list-inline-item">
                    <?php
                        if($local->categoria_id != 0){
							$categoria=$local->getCategoria()->one();
							$nombre=$categoria->nombre;
                        }else
                            $nombre="Sin categoría";
                    ?>
                    <p class="text-muted">Categoría: <?= Html::encode("{$nombre}")?></p>
                </li>
            </ul>
            <ul class="list-unstyled list-inline mb-0">
                <li class="list-inline-item">
					<?php $zonas=Local::listaZonas(); ?>
                    <p class="text-muted">Zona: <?= Html::encode("{$zonas[$local->zona_id]}")?></p>
                </li>
                <li class="list-inline-item">
					<?php if(isset($local->url) && $local->url != ''): ?>
                        <p class="text-muted"><a href="<?= Html::encode("{$local->url}")?>" target="_blank">Visita la web</a></p>
					<?php endif; ?>
                </li>
            </ul>
            <p class="mb-2">
				<?php
				if(isset($local->lugar) && $local->lugar!='')
					echo Html::encode("{$local->lugar}");
				else
					echo Html::encode("No hay nada por el momento...");
				?>
            </p>
            <p class="card-text">
                <?php
                    if(isset($local->descripcion) && $local->descripcion!='')
                        echo Html::encode("{$local->descripcion}");
                    else
                        echo Html::encode("No hay nada por el momento...");
                ?>
            </p>
            <a href="<?= Url::toRoute(['local/detalle', 'id'=>$local->id]);?>" class="btn btn-link link-secondary p-md-1 mb-0">Saber más</a>
        </div>
    </div>

</section>
