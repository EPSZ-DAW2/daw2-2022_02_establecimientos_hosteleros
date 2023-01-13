<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\HostelerosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card card-5 mt-5 mb-3">

    <div class="card-body hostelero-search">
        <h3 class="mb-2">Búsqueda avanzada</h3>
		<?php $form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
			'options' => [
				'data-pjax' => 1
			],
		]); ?>
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'nombre')->label('Nombre Hostelero')  //Nombre Usuario Hostelero?>
            </div>
            <div class="col-4">
				<?= $form->field($model, 'apellidos')->label('Apellidos Hostelero')  //Apellidos Usuario Hostelero?>
            </div>
            <div class="col-4">
				<?= $form->field($model, 'nif_cif')->label('CIFNIF') ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4">
				<?= $form->field($model, 'razon_social')->label("Razón social") ?>
            </div>
            <div class="col-4">
				<?= $form->field($model, 'telefono_comercio')->label("Teléfono de comercio") ?>
            </div>
            <div class="col-4">
				<?= $form->field($model, 'telefono_contacto')->label("Teléfono de contacto") ?>
            </div>
        </div>

        <div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Buscar'), ['class' => 'btn colorlogin mt-2']) ?>
            <a href="<?= Url::toRoute(['hostelero/index']);?>" class="btn btn-outline-secondary mt-2">Resetear</a>
        </div>

		<?php ActiveForm::end(); ?>

    </div>
</div>

