<?php

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
<div class="usuario-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Inicio'), ['index'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Confirmar Usuarios'), ['confirmarusuarios'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'RBAC'), ['rbac'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Crear Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

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
