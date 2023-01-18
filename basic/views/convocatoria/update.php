<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */

$this->title = 'Update Convocatoria: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Convocatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="convocatoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_up', [
        'model' => $model,
    ]) ?>

</div>
