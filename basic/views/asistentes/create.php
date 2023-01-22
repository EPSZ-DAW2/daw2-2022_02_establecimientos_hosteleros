<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Asistente $model */

$this->title = 'Crear Asistente';
$this->params['breadcrumbs'][] = ['label' => 'Convocatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="asistente-form">
    
    <?= $this->render('_form', [
        'model' => $model,'convocatoria'=>$convocatoria,'local'=>$local
    ]) ?>

</div>

</div>
