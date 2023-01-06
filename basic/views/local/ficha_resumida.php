<?php
//Ficha resumida de un local
use \app\models\Local;
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
                        <?php $valoracion=$local->sumaValores/$local->totalVotos; ?>
                        <p class="text-muted"><?= Html::encode("{$valoracion}")?> (<?= Html::encode("{$local->totalVotos}")?>)</p>
                    </li>
                    <li class="list-inline-item">
                        <?php $zonas=Local::listaZonas(); ?>
                        <p class="text-muted">Zona: <?= Html::encode("{$zonas[$local->zona_id]}")?></p>
                    </li>
                    <li class="list-inline-item">
                        <p class="text-muted"><a href="<?= Html::encode("{$local->url}")?>" target="_blank">Visita la web</a></p>
                    </li>
                </ul>
                <p class="mb-2"><?= Html::encode("{$local->lugar}")?></p>
                <p class="card-text">
                    <?php
                        if(isset($local->descripcion) && $local->descripcion!='')
                            echo Html::encode("{$local->descripcion}");
                        else
                            echo Html::encode("No hay nada por el momento...");
                    ?>
                </p>
                <a href="#!" class="btn btn-link link-secondary p-md-1 mb-0">Saber más</a>
            </div>
        </div>

    </section>
