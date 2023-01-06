<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
            <div class="card rounded-3 text-black">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">

                            <div class="text-center">
                                <h4 class="mt-1 mb-5 pb-1">Login</h4>
                            </div>

							<?php $form = ActiveForm::begin([
								'id' => 'login-form',
							]); ?>
                            <p>Indica tus credenciales para iniciar sesión:</p>

                            <div class="form-outline mb-4">
                                <label for="email">Email:</label>
								<?= $form->field($model, 'username')->textInput(['autofocus' => true, 'id'=>'email'])->label(false) ?>
                            </div>

                            <div class="form-outline mb-4">
                                <label for="pass">Contraseña:</label>
								<?= $form->field($model, 'password')->passwordInput(['id'=>'pass'])->label(false) ?>
                            </div>
                            <div class="form-outline mb-4">
								<?= $form->field($model, 'rememberMe')->label("Recordarme")->checkbox([
								]) ?>
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
								<?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-primary btn-block fa-lg gradient-custom-2 mb-3', 'name' => 'login-button']) ?>
                                <br>
								<?php
								if(isset($error))
									echo $error;
								?>
                            </div>


                            <div class="d-flex align-items-center justify-content-center pb-4">
                                <p class="mb-0 me-2">¿No tienes una cuenta?</p>

                                <a class="btn btn-outline-danger" href="<?= Url::toRoute(['site/registro']);?>">Regístrate</a>
                            </div>

							<?php ActiveForm::end(); ?>

                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                            <h4 class="mb-4">Establecimientos hosteleros</h4>
                            <p class="small mb-0">En esta aplicación se podrán ver, buscar y consultar
                                diferentes establecimientos hosteleros (bares, restaurantes, etc.)
                                con la intención de encontrar las opiniones sobre ellos y sobre todo recomendaciones.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
