<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocalesEtiquetas $model */

$this->title = Yii::t('app', 'Crear etiqueta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locales Etiquetas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locales-etiquetas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
