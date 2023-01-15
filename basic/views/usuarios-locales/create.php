<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UsuariosLocales $model */

$this->title = Yii::t('app', 'Create Usuarios Locales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios Locales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-locales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
