<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\usuarioAviso $model */

$this->title = Yii::t('app', 'Enviados');?>
<br><div  class="text-center">
<br>
<h1><?= Html::encode($this->title) ?></h1>

<?php foreach ($model as $linea){

    echo '<br>';?>
    <div>
        <p style="overflow:hidden;
           white-space:nowrap;
           text-overflow: ellipsis;">Mensaje:<?php echo $linea->texto?></p>
        
        <p><?=    Html::a(Yii::t('app', "Leer"), ['leer', 'id' => $linea->id], ['class' => 'btn btn-primary']);?></p>
    </div>
  
<?php
}
?>  </div>