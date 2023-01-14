<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\usuarioAviso $model */

$this->title = Yii::t('app', 'Recibidos');?>
<br>
<br>
<h1><?= Html::encode($this->title) ?></h1>
<?php foreach ($model as $linea){

    echo '<br>';?>
    <div>
        <?php if($linea->fecha_lectura == null) {
            echo '<p style="color:red">Mensaje Nuevo</p>';
        }?>
        <p style="overflow:hidden;
           white-space:nowrap;
           text-overflow: ellipsis;">Mensaje:<?php echo $linea->texto?></p>
        <p><?=  Html::a(Yii::t('app', "Marcar como 'No leído'"), ['desleer', 'id' => $linea->id], ['class' => 'btn btn-primary']);?>
            <?=    Html::a(Yii::t('app', "Leer"), ['leer', 'id' => $linea->id], ['class' => 'btn btn-primary']);?></p>
    </div>
<?php
}
?>