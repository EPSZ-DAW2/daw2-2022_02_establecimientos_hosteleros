<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
/** @var app\models\Local $local */
/** @var app\models\ChangePasswordForm $model */

?>
    <div class="locales-mantenimiento-form">
        <h1>Cambio de contraseña</h1>
<?php
NavBar::begin([
	'brandLabel' => 'Mi perfil',
	'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
]);
$items=[
	['label' => 'Perfil', 'url' => ['/mi-perfil']],
	['label' => 'Mensajes', 'url' => ['/mi-perfil/mensajes']],
	['label' => 'Locales', 'url' => ['/mi-perfil/establecimientos']],
	['label' => 'Seguidos', 'url' => ['/mi-perfil/seguimiento']],
];
echo Nav::widget([
	'options' => ['class' => 'navbar-nav'],
	'items' => $items,
]);
NavBar::end();
$form = ActiveForm::begin([
    'action' => ['mi-perfil/updatecontra'],
]);;

echo $form->field($model, 'password')->passwordInput()->label('Contraseña');
echo $form->field($model, 'password_repeat')->passwordInput()->label('Repita Contraseña');

echo Html::submitButton('Cambiar contraseña', ['class' => 'btn btn-success']);

ActiveForm::end();

