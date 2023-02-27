<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LocalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
details > summary {
  padding: 2px 6px;
  width: 15em;
  border: none;
  cursor: pointer;
  list-style: none;
}

details > p {
  padding: 2px 6px;
  margin: 0;
}

details > #_form {
    display: flex;
    flex-direction: row;
    gap: 4px 8px;
}

</style>


<div class="local-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo')->label('Busqueda de locales') ?>

    <?php //$form->field($model, 'descripcion') ?>

    <?php //$form->field($model, 'lugar') ?>

    <?php //$form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'zona_id') ?>

    <?php // echo $form->field($model, 'categoria_id') ?>

    <?php // echo $form->field($model, 'imagen_id') ?>

    <?php // echo $form->field($model, 'sumaValores') ?>

    <?php // echo $form->field($model, 'totalVotos') ?>

    <?php // echo $form->field($model, 'hostelero_id') ?>

    <?php // echo $form->field($model, 'prioridad') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'terminado') ?>

    <?php // echo $form->field($model, 'fecha_terminacion') ?>

    <?php // echo $form->field($model, 'num_denuncias') ?>

    <?php // echo $form->field($model, 'fecha_denuncia1') ?>

    <?php // echo $form->field($model, 'bloqueado') ?>

    <?php // echo $form->field($model, 'fecha_bloqueo') ?>

    <?php // echo $form->field($model, 'notas_bloqueo') ?>

    <?php // echo $form->field($model, 'cerrado_comentar') ?>

    <?php // echo $form->field($model, 'cerrado_quedar') ?>

    <?php // echo $form->field($model, 'crea_usuario_id') ?>

    <?php // echo $form->field($model, 'crea_fecha') ?>

    <?php // echo $form->field($model, 'modi_usuario_id') ?>

    <?php // echo $form->field($model, 'modi_fecha') ?>

    <?php // echo $form->field($model, 'notas_admin') ?>
    </br>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn pl-2 pr-2 mb-0 btn-default']) ?>
        <?php //Html::Button('Busqueda avanzada', ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <details class="btn btn-light"><summary>Busqueda avanzada</summary>
        <div id="_form" class="card card-5 mt-5 mb-3">
            <div class="card-body">
                <?php echo $this->render('_form', ['model' => $model]); ?>
            </div>
        </div>
    </details>

    <?php ActiveForm::end(); ?>

</div>
