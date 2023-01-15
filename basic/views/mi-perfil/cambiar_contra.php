<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var app\models\Local $local */
/** @var app\models\ChangePasswordForm $model */

?>
    <div class="locales-mantenimiento-form">
        <h1>Cambio de contraseña</h1>
<?php

$form = ActiveForm::begin([
    'action' => ['mi-perfil/updatecontra'],
]);;

echo $form->field($model, 'password')->passwordInput()->label('Contraseña');
echo $form->field($model, 'password_repeat')->passwordInput()->label('Repita Contraseña');

echo Html::submitButton('Cambiar contraseña', ['class' => 'btn btn-success']);

ActiveForm::end();

