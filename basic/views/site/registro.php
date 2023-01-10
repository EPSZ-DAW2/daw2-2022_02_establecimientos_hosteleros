<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use app\models\Usuario;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container py-5 h-100">
	<div class="row d-flex justify-content-center align-items-center h-100">
		<div class="col-xl-10">
			<div class="card rounded-3 text-black">
				<div class="row g-0">
					<div class="col-lg-6 d-flex align-items-center gradient-custom-2">
						<div class="text-white px-3 py-4 p-md-5 mx-md-4">
							<h4 class="mb-4">Regístrate en establecimientos hosteleros</h4>
							<p class="small mb-2">Una vez te registres, tu cuenta será revisada y aprobada por un
								administrador para que puedas comenzar a usarla.</p>
							<p class="small mb-0">En esta aplicación se podrán ver, buscar y consultar
								diferentes establecimientos hosteleros (bares, restaurantes, etc.)
								con la intención de encontrar las opiniones sobre ellos y sobre todo recomendaciones.</p>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card-body p-md-5 mx-md-4">

							<div class="text-center">
								<h4 class="mt-1 mb-5 pb-1">Registro</h4>
							</div>

							<?php $form = ActiveForm::begin([
								'id' => 'login-form',
							]); ?>
							<p>Rellena los siguientes campos para crear tu cuenta:</p>

							<div class="form-outline mb-4">
								<?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Email: *") ?>
							</div>

							<div class="form-outline mb-4">
								<?= $form->field($model, 'nick')->textInput(['autofocus' => true])->label("Nick: *") ?>
							</div>

							<div class="form-outline mb-4">
								<?= $form->field($model, 'nombre')->textInput(['autofocus' => true])->label("Nombre: *") ?>
							</div>

							<div class="form-outline mb-4">
								<?= $form->field($model, 'apellidos')->textInput(['autofocus' => true])->label("Apellidos: *") ?>
							</div>

							<div class="form-outline mb-4">
								<label for="usuario-fecha_nacimiento">Fecha de nacimiento</label>
								<?= $form->field($model, 'fecha_nacimiento')->widget(\yii\jui\DatePicker::className(),
									[ 'dateFormat' => 'php:Y/m/d',
										'language' => 'es',
										'clientOptions' => [
											'changeYear' => true,
											'changeMonth' => true,
											'yearRange' => '-50:-12',
											'altFormat' => 'yyyy-mm-dd',
										]],['placeholder' => 'dd/mm/yyyy'])
									->textInput(['placeholder' => \Yii::t('app', 'dd/mm/yyyy')])->label(false) ;?>
							</div>
							<div class="form-outline mb-4">
								<?= $form->field($model, 'direccion')->textInput(['autofocus' => true])->label("Dirección") ?>
							</div>

							<?php $zonas=Usuario::listaZonas();?>

							<div class="form-outline mb-4">
								<label for="zona">Zona Geográfica *</label>
								<?= $form->field($model, 'zona_id')->dropDownList($zonas,['id'=>'zona','autofocus' => true,
									'prompt'=>'Selecciona una ...'])->label(false) ?>
							</div>

							<div class="form-outline mb-4">
								<label for="pass">Contraseña *</label>
								<?= $form->field($model, 'password')->passwordInput(['id'=>'pass'])->label(false) ?>
							</div>

							<div class="text-center pt-1 mb-5 pb-1">
								<?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary btn-block fa-lg gradient-custom-2 mb-3', 'name' => 'login-button']) ?>
                            </div>

							<div class="d-flex align-items-center justify-content-center pb-4">
								<p class="mb-0 me-2">¿Tienes una cuenta?</p>

								<a class="btn btn-outline-danger" href="<?= Url::toRoute(['site/login']);?>">Inicia sesión</a>
							</div>

							<?php ActiveForm::end(); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>