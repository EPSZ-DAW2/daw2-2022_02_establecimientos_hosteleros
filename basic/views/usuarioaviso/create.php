<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuarioaviso $model */

$this->title = Yii::t('app', 'Create Usuarioaviso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarioavisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarioaviso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
