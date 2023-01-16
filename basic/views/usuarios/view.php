<?php

use app\models\Usuario;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */

$this->title = 'Usuario: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de querer borrar este usuario?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'password',
            'nick',
            'nombre',
            'apellidos',
            'fecha_nacimiento',
            'direccion:ntext',
			[
				'attribute'=>'zona_id',
				'value'=> $model->zona_id.'-'.$model->getDescripcionZona(),
			],
            'fecha_registro',
			[
				'attribute'=>'confirmado',
				'value'=> $model->descripcionOpcion($model->confirmado),
			],
            'fecha_acceso',
            'num_accesos',
			[
				'attribute'=>'bloqueado',
				'value'=> $model->descripcionOpcionBloqueo($model->bloqueado),
			],
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
        ],
    ]) ?>
</div>
