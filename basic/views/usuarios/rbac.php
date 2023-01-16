<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\data\ArrayDataProvider;
use app\models\Rol;
use app\models\Usuario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UsuariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'RBAC Usuarios');
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

    <h2 class="mt-4">Lista de roles disponibles</h2>
    <?php
	$lineasProvider= new ArrayDataProvider([
		//Se comprueba si es una instancia activa para que devuelva el objeto de consulta o de datos
		'allModels'=>Rol::listaRoles()->all(),
		'pagination'=>false,
		'sort'=>false,
	]);
    ?>

	<?= GridView::widget([
		'dataProvider' => $lineasProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'id',
			'nombre',
		],
	]); ?>


    <h2 class="mt-4">Asignación de roles a usuarios</h2>
	<?php Pjax::begin(); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'id',
			'email:email',
			'nick',
			[
				'header' => 'Moderador',
				'content' => function($model) {
                    if(Usuario::esRolModerador($model->id))
					    return Html::a(Yii::t('app', 'Si'), ['rbac', 'id'=>$model->id, 'rol'=>1, 'accion'=>0], ['class' => 'btn btn-success w-100']);
				    else
						return Html::a(Yii::t('app', 'No'), ['rbac', 'id'=>$model->id, 'rol'=>1, 'accion'=>1], ['class' => 'btn btn-danger w-100']);
				}
			],
			[
				'header' => 'Patrocinador',
				'content' => function($model) {
					if(Usuario::esRolPatrocinador($model->id))
						return Html::a(Yii::t('app', 'Si'), ['rbac', 'id'=>$model->id , 'rol'=>2, 'accion'=>0], ['class' => 'btn btn-success w-100']);
					else
						return Html::a(Yii::t('app', 'No'), ['rbac', 'id'=>$model->id , 'rol'=>2, 'accion'=>1], ['class' => 'btn btn-danger w-100']);
				}
			],
			[
				'header' => 'Administrador',
				'content' => function($model) {
					if(Usuario::esRolAdmin($model->id))
						return Html::a(Yii::t('app', 'Si'), ['rbac', 'id'=>$model->id , 'rol'=>3, 'accion'=>0], ['class' => 'btn btn-success w-100']);
					else
						return Html::a(Yii::t('app', 'No'), ['rbac', 'id'=>$model->id, 'rol'=>3, 'accion'=>1], ['class' => 'btn btn-danger w-100']);
				}
			],
		],
	]); ?>

	<?php Pjax::end(); ?>

</div>
