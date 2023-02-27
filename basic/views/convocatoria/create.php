<?php

use yii\helpers\Html;

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\UsuarioRol;
//Para la parte de Angel
use app\models\Usuario;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */

$this->title = 'Create Convocatoria';
$this->params['breadcrumbs'][] = ['label' => 'Convocatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convocatoria-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        include('menu.php');
    ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
