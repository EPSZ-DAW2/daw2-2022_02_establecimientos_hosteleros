<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Zonas $model */

$this->title = 'Create Zonas';
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zonas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
