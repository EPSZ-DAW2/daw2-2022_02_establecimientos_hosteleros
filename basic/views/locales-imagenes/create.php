<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocalesImagenes $model */

$this->title = Yii::t('app', 'Create Locales Imagenes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locales Imagenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locales-imagenes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
