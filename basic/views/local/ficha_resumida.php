<?php
//Ficha resumida de un local
use \app\models\Local;
use yii\helpers\Url;
use yii\helpers\Html; ?>

<section class="mx-3 my-3" style="max-width: 23rem;">

    <div class="card">
        <div>
            <?php //Poner la url de donde se guarda la foto
            if(isset($local->imagen_id) && $local->imagen_id!=''): ?>
                <?php if(file_exists('uploadimages/'.$local->imagen_id.'.jpg') || file_exists('uploadimages/'.$local->imagen_id.'.png')): ?>
                    <img src="uploadimages/<?= $local->imagen_id?>" class="img-fluid"/>
				<?php else:?>
                    <img src="images/sinfoto.jpg" class="img-fluid" style="width: 100%; height: 15rem" />
				<?php endif; ?>
            <?php else:?>
                <img src="images/sinfoto.jpg" class="img-fluid" style="width: 100%; height: 15rem" />
            <?php endif; ?>
        </div>
        <div class="card-body info">
            <h5 class="card-title font-weight-bold"><a><?= Html::encode("{$local->titulo}")?></a></h5>
            <ul class="list-unstyled list-inline mb-0">
                <li class="list-inline-item">
                    <?php
                    if($local->totalVotos!=0){
                        if($local->sumaValores/$local->totalVotos != null || $local->sumaValores/$local->totalVotos != 0)
                            $valoracion=$local->sumaValores/$local->totalVotos;
                        else
                            $valoracion="Sin valoraciones";
                    }else{
                        $valoracion="Sin valoraciones";
                    }

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
                    <p class="text-muted">Zona: <?php echo ($local->zona_id!=0) ? Html::encode("{$zonas[$local->zona_id]}") : 'Sin informar'?></p>
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
            <div class="d-flex justify-content-center">
                <a href="<?= Url::toRoute(['detalle-locales/index', 'idLocal'=>$local->id]);?>" class="btn pl-2 pr-2 mb-0 btn-default">Saber más</a>
            </div>
        </div>
    </div>

</section>
