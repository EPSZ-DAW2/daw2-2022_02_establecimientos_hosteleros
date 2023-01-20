<?php

use yii\helpers\Html;

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\UsuarioRol;
//Para la parte de Angel
use app\models\Usuario;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */

$this->title = ' Editar Convocatoria: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Convocatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="convocatoria-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        if(!(Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
            NavBar::begin([
                'brandLabel' => '',
                'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
            ]);
            $items=[
                ['label' => 'Ver Convoctorias', 'url' => ['convocatoria/index']],
                ['label' => 'Crear convoctorias', 'url' => ['convocatoria/create']],
                ['label' => 'Administrar convocatorias propias', 'url' => ['convocatoria/verpropias']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => $items,
            ]);
            NavBar::end();
        }
    ?>
    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
