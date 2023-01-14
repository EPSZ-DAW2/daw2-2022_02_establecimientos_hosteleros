<?php

use app\models\Usuarioaviso;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */

$this->title = Yii::t('app', 'Mensaje');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MiPerfil'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

;?>
<div class="usuarioaviso-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($model->fecha_lectura == null) {
        echo '<p style="color:red">Mensaje Nuevo</p>';
    }?>
    <p><?php echo $model->texto; ?></p>
    <p><?=  Html::a(Yii::t('app', "Marcar como 'No leído'"), ['desleermsg', 'id' => $model->id], ['class' => 'btn btn-secondary']);?>
        <?=    Html::a(Yii::t('app', "Volver"), ['index'], ['class' => 'btn btn-primary']);?></p>
</div>