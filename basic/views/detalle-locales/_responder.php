<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\models\LocalesComentarios;

//Responder a &usu:
$form = ActiveForm::begin(['action' =>['detalle-locales/comentar'], 'id' => 'detalle-locales', 'method' => 'post',]); 
$model = new LocalesComentarios();?>

<div class="form-group">
    <p class="clasificacion">
        <?= $form->field($model, 'local_id')->hiddenInput(array('value'=>$local_id))->label(false) ?>
        <?= $form->field($model, 'crea_usuario_id')->hiddenInput(array('value'=>$idUsuario))->label(false) ?>
        <?= $form->field($model, 'comentario_id')->hiddenInput(array('value'=>$idComentario))->label(false) ?>
        <?= $form->field($model, 'valoracion')->hiddenInput(array('value'=>0))->label(false)?>
    </p>
    <?=$form->field($model, 'texto')->textInput()?>
    <div>
        <?= $form->field($model, 'cerrado')->checkbox(['value' => 1])->label('Comentario cerrado'); ?>
        
    </div>
    <?= Html::submitButton('Responder', ['class' => 'btn pl-2 pr-2 mb-0 btn-default']) ?></br></br>
</div>
</div>
<div class="d-flex justify-content-center">
<?php ActiveForm::end();
