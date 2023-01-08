<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Configuracion $model */

$this->title = $model->variable;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuraciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="configuracion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'variable' => $model->variable], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'variable' => $model->variable], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de querer borrar esta configuración?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'variable',
            'valor:ntext',
        ],
    ]) ?>

</div>
