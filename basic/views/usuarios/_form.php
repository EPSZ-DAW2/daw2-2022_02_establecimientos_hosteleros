<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'fecha_nacimiento')->widget(\yii\jui\DatePicker::className(),
		[ 'dateFormat' => 'php:Y/m/d',
			'language' => 'es',
			'clientOptions' => [
				'changeYear' => true,
				'changeMonth' => true,
				'yearRange' => '-50:-12',
				'altFormat' => 'yyyy-mm-dd',
			]],['placeholder' => 'dd/mm/yyyy'])
		->textInput(['placeholder' => \Yii::t('app', 'dd/mm/yyyy')]) ;?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>

    <?php if(empty($model) && ($model::esRolModerador($model->id) || $model::esRolAdmin($model->id))):?>
    <p>Zona de moderación: <?php
		$zonas=$model::listaZonas();
		$zona=$model->getZonasModeracion()->one();
        if (isset($zona) && $zona!=null)
		    echo $zonas[$zona->zona_id];
        else
            echo 'No tiene zona asignada';
        ?>
        <?php //TODO Cambiar URL a la ruta de mantenimento de zonas de moderación para usuarios admin y moderadores ?>
        <a href="<?= Url::toRoute(['usuarios/view', 'id'=>$model->id]);?>"> Asigna una zona</a>
    </p>

    <?php endif; ?>

	<?= $form->field($model, 'zona_id')->dropDownList($model::listaZonas()) ?>

	<?= $form->field($model, 'fecha_registro')->widget(\yii\jui\DatePicker::className(),
		[ 'dateFormat' => 'php:Y/m/d',
			'language' => 'es',
			'clientOptions' => [
				'changeYear' => true,
				'changeMonth' => true,
				'yearRange' => '-50:-12',
				'altFormat' => 'yyyy-mm-dd',
			]],['placeholder' => 'dd/mm/yyyy'])
		->textInput(['placeholder' => \Yii::t('app', 'dd/mm/yyyy')]) ;?>

	<?= $form->field($model, 'confirmado')->dropDownList($model::listaOpciones()) ?>

	<?= $form->field($model, 'fecha_acceso')->widget(\yii\jui\DatePicker::className(),
		[ 'dateFormat' => 'php:Y/m/d',
			'language' => 'es',
			'clientOptions' => [
				'changeYear' => true,
				'changeMonth' => true,
				'yearRange' => '-50:-12',
				'altFormat' => 'yyyy-mm-dd',
			]],['placeholder' => 'dd/mm/yyyy'])
		->textInput(['placeholder' => \Yii::t('app', 'dd/mm/yyyy')]) ;?>

    <?= $form->field($model, 'num_accesos')->textInput() ?>

	<?= $form->field($model, 'bloqueado')->dropDownList($model::listaOpcionesBloqueo()) ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <div class="form-group mt-2">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
