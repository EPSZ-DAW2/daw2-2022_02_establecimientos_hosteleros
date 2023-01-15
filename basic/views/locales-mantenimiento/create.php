<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocalesMantenimiento $model */

$this->title = Yii::t('app', 'Create Locales Mantenimiento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locales Mantenimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locales-mantenimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>