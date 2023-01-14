<?php

use app\models\Registro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\RegistroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Registros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Registro'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Exportar Todo'), ['exportar-todo'], ['class' => 'btn btn-primary']) ?>

    </p>


<?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_registro',
            [ 'attribute'=>'clase_log_id',
                'filter'=> \app\models\Registro::listaEstados(),
                'content'=>function($model, $key, $index, $column) {
                    return $model->descripcionEstado;
                }
                , 'contentOptions' => ['class'=>'text-center']
            ],
            'modulo',
            'texto:ntext',
            'ip',
            'browser:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <div class="registro">
        <h2><?= Html::encode('Eliminar por valores') ?></h2>
        <?php $form = ActiveForm::begin([
            'action' => ['elimianar-filtro'],
            'method' => 'get',
        ]);
        $model = new Registro();?>

        <?=$form->field($model,'fecha')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
        ])?>
        <?= $form->field($model, 'modulo')->textInput() ?>
        <?= $form->field($model, 'texto')->textInput() ?>
        <?= $form->field($model, 'ip')->textInput() ?>
        <?= $form->field($model, 'browser')->textInput() ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Eliminar'), ['class' => 'btn btn-success']) ?></div>
        <?php ActiveForm::end(); ?>
    </div>


    <br>

    <div class="registro">
        <h2><?= Html::encode('Eliminar por Tipo de aviso') ?></h2>
        <?php $form = ActiveForm::begin([
            'action' => ['elimianar-filtro'],
            'method' => 'get',
        ]);
        $model = new Registro();?>
        <?= $form->field($model, 'clase_log_id')->dropDownList( \app\models\Registro::listaEstados()) ?>
        <br>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Eliminar'), ['class' => 'btn btn-success']) ?></div>
        <?php ActiveForm::end(); ?>
    </div>
    <br>

</div>
