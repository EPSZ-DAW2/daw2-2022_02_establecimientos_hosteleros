<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuario;
use app\models\Local;
use app\models\LocalesEtiquetas;
use app\models\Etiquetas;

/* @var $this yii\web\View */
/* @var $model app\models\Local */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="local-form">

    <?php $form = ActiveForm::begin([
        'action' => ['_search'],
        'method' => 'post',
    ]); ?>


<?php //$form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

<?php //////$form->field($model, 'lugar')->textarea(['rows' => 6]) ?>

<?php //$form->field($model, 'url')->textarea(['rows' => 6]) ?>


<?php $zonas = Usuario::listaZonas(); ?>
<div class="d-flex row">
        <div class="col">
            <?= $form->field($model, 'zona_id')->dropDownList($zonas,['id'=>'zona','autofocus' => true,
                                            'prompt'=>'Selecciona una ...'])->label('Zonas') ?>
        </div>
        
        <?php $categorias = Local::listaCategorias(); ?>
        <div class="col">
            <?= $form->field($model, 'categoria_id')->dropDownList($categorias, ['id'=>'categoria','autofocus' => true,
                                            'prompt'=>'Selecciona una ...'])->label('Categorias') ?>
        </div>
        
        <?php $etiquetas = Etiquetas::listaEtiquetas(); 
                $modelE = new LocalesEtiquetas;
        ?>
        <div class="col">
            <?= $form->field($model, 'etiqueta_id')->dropDownList($etiquetas, ['id'=>'etiqueta','autofocus' => true,
                                            'prompt'=>'Selecciona una ...'])->label('Etiquetas') ?>
        </div>

        <!-- $userQuery = (new Query)->select('id')->from('user');
        $query->where(['id' => $userQuery]); 
        que generará el siguiente código SQL:
        WHERE `id` IN (SELECT `id` FROM `user`)-->
        
    <!-- <div class="row">
        <div class="col">
            <?php //$form->field($model, 'imagen_id')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col">
            <?php // $form->field($model, 'sumaValores')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'totalVotos')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'hostelero_id')->textInput() ?>
        </div>
        
        <div class="col">
            <?php // $form->field($model, 'prioridad')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'visible')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'terminado')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'fecha_terminacion')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'num_denuncias')->textInput() ?>
        </div>
        
        <div class="col">
            <?php // $form->field($model, 'fecha_denuncia1')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'bloqueado')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'fecha_bloqueo')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'cerrado_comentar')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'cerrado_quedar')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'crea_usuario_id')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'crea_fecha')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'modi_usuario_id')->textInput() ?>
        </div>

        <div class="col">
            <?php // $form->field($model, 'modi_fecha')->textInput() ?>
        </div>
        
        <div class="col">
            <?php // $form->field($model, 'notas_admin')->textarea(['rows' => 6]) ?>
        </div> -->

        <div class="col d-flex align-items-center justify-content-center">
            <div class="row-2">
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
