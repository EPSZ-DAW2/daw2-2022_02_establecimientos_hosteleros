<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Asistente $model */

$this->title = 'Create Asistente';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
