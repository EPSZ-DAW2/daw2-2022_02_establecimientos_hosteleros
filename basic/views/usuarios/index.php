<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\Usuario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UsuariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
NavBar::begin([
	'brandLabel' => 'Administración Usuarios',
	'options' => ['class' => 'navbar-expand-md navbar-light navcolor mb-3'],
]);
$items=[
	['label' => 'Usuarios', 'url' => ['/usuarios/index']],
	['label' => 'Confirmar usuarios', 'url' => ['/usuarios/confirmarusuarios']],
	['label' => 'RBAC', 'url' => ['/usuarios/rbac']],
	['label' => 'Crear usuario', 'url' => ['/usuarios/create']],
];
echo Nav::widget([
	'options' => ['class' => 'navbar-nav'],
	'items' => $items,
]);
NavBar::end();
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'email:email',
            'nick',
            'nombre',
            'apellidos',
            'fecha_nacimiento',
            'direccion:ntext',
			[
				'attribute'=>'zona_id',
				'content'=> function($model, $key, $index, $column){
					return $model->descripcionZona;
				},
				'contentOptions'=>['class'=>'text-center'],
				'filter'=>\app\models\Usuario::listaZonas(),
			],
            'fecha_registro',
			[
				'attribute'=>'confirmado',
				'content'=> function($model, $key, $index, $column){
					return $model->descripcionOpcion($model->confirmado);
				},
				'contentOptions'=>['class'=>'text-center'],
				'filter'=>\app\models\Usuario::listaOpciones(),
			],
			[
				'attribute'=>'bloqueado',
				'content'=> function($model, $key, $index, $column){
					return $model->descripcionOpcionBloqueo($model->bloqueado);
				},
				'contentOptions'=>['class'=>'text-center'],
				'filter'=>\app\models\Usuario::listaOpcionesBloqueo(),
			],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
