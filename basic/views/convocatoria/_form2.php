<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//para el tema de roles

use app\models\UsuarioRol;

//Para la parte de Angel
use app\models\Usuario;

/** @var yii\web\View $this */
/** @var app\models\Convocatoria $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="convocatoria-form">
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'local_id')->hiddenInput([ 'value' => $model->id])->label(false) ?>

<?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'fecha_solo_inicio')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
        ])->label("Fecha de inicio") ?>

    <?= $form->field($model, 'fecha_solo_fin')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
        ])->label("Fecha de finalización") ?>

    <?= $form->field($model, 'hora_solo_inicio')->textInput()->label("Hora de inicio") ?>
    <?= $form->field($model, 'hora_solo_fin') ->textInput()->label("Hora de finalización")?>

<?= $form->field($model, 'num_denuncias')->hiddenInput([ 'value' => $model->num_denuncias])->label(false) ?>

<?php //si es admin que pueda modificar
    if(Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id)){
?>
        <?= $form->field($model, 'bloqueada')->textInput() ?>
<?php } else {?>
        <?= $form->field($model, 'bloqueada')->hiddenInput([ 'value' => $model->bloqueada ])->label(false) ?>
<?php } ?>

<?= $form->field($model, 'fecha_bloqueo')->hiddenInput([ 'value' => $model->fecha_bloqueo ])->label(false) ?>

<?php //si es admin que pueda modificar
    if(Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id)){
?>
        <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>
    <?php } else { //si no que solo muestre
    //si esta bloqueada
            if($model->bloqueada != 0){
                echo Html::tag('h3','Convocatoria bloqueada por: '.($model->bloqueada == 1 ? 'Denuncias' : 'Administrador'),['class' => 'error-summary']);
                echo Html::tag('p',$model->notas_bloqueo,['class' => 'error-summary']);
            }
        ?>        
        <?= $form->field($model, 'notas_bloqueo')->hiddenInput([ 'value' => $model->notas_bloqueo ])->label(false) ?>
    <?php } ?>
<?php //$form->field($model, 'modi_usuario_id')->textInput() ?>
<?= $form->field($model, 'modi_usuario_id')->hiddenInput([ 'value' =>0])->label(false) ?>

<?php //$form->field($model, 'modi_fecha')->textInput() ?>
<?= $form->field($model, 'modi_fecha')->hiddenInput([ 'value' => date('Y-m-d H:i:s') ])->label(false) ?>

</br>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>