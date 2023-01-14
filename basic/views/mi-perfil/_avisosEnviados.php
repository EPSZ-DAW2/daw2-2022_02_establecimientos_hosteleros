<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\usuarioAviso $model */

$this->title = Yii::t('app', 'Enviados');

foreach ($model as $linea){

    var_dump($linea->fecha_lectura);
    var_dump($linea->fecha_aceptado);
    echo '<br>';?>
    <div>
        <?php if($linea->fecha_lectura == null) {
            echo '<p style="color:red">Mensaje Nuevo</p>';
        }?>
        <p style="overflow:hidden;
           white-space:nowrap;
           text-overflow: ellipsis;">Mensaje:<?php echo $linea->texto?></p>
        <p></p>
    </div>
<?php
}
?>