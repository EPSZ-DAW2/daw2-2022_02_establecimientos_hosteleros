<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\usuarioAviso $model */

$this->title = Yii::t('app', 'Recibidos');?>
<br><div  class="text-center">
<br>
<h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a(Yii::t('app', 'Todos'), ['mensajes'], ['class' => 'btn btn-success', 'data' => ['method' => 'post', 'params' => ['recibidos' => null]]])?>
    <?= Html::a(Yii::t('app', 'Mensajes leidos'), ['mensajes'], ['class' => 'btn btn-success', 'data' => ['method' => 'post', 'params' => ['recibidos' => 'leido']]])?>
    <?= Html::a(Yii::t('app', 'Mensajes no leidos'), ['mensajes'], ['class' => 'btn btn-success', 'data' => ['method' => 'post', 'params' => ['recibidos' => 'no-leido']]])?>

    <?php if(empty($model)){
        echo '<h2>No hay mensajes recibidos</h2>';
    }else{?>

        <?php foreach ($model as $linea){

    echo '<br>';?>
    <div class="row">

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
}
    ?>  </div>