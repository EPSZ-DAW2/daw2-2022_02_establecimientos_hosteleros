<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\Usuario;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800|Old+Standard+TT' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800' rel='stylesheet' type='text/css'>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
	<?php
	
	//NavBar para usuario administrador
    NavBar::begin([
        'brandLabel' => '<img src="images/logo.png" class="pull-left" style="height: 50px"/> '.Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md fixed-top navbar-light navcolor'],
    ]);

	//Definir items de la barra de navegación en un array
	//TODO Poner un item de las funcionalidades privadas asignadas
	$items=[
		['label' => 'Usuarios', 'url' => ['/usuarios/index']],
		['label' => 'Locales', 'url' => ['locales-mantenimiento/index']],
		['label' => 'Avisos', 'url' => ['/usuarioaviso/index']],
		['label' => 'Configuraciones', 'url' => ['/configuraciones/index']],
		['label' => 'Convocatorias', 'url' => ['/convocatoria/index']],
        ['label' => 'Registro', 'url' => ['/registro/index']],
		['label' => 'Perfil', 'url' => ['/mi-perfil']],
		['label' => 'Zonas', 'url' => ['/zonas/index']],
		['label' => 'Backups', 'url' => ['/backup/index']],
	];
	//Si el usuario es adm
    /*if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
        array_push($items, ['label' => 'Zonas', 'url' => ['/zonas/index']]);
    }
    //Si el usuario es adm
    if((Usuario::esRolAdmin(Yii::$app->user->id) || Usuario::esRolSistema(Yii::$app->user->id))){
        array_push($items, ['label' => 'Backups', 'url' => ['/backup/index']]);
    }*/
	//Si el usuario es invitado se añaden opciones de login y registro, si no de logout
    if(Yii::$app->user->isGuest){
        array_push($items, ['label' => 'Login', 'url' => ['/site/login']], ['label' => 'Registro', 'url' => ['/site/registro']]);
    }else{
        array_push($items, '<li class="nav-item">'. Html::beginForm(['/site/logout']). Html::submitButton('Cerrar Sesión (' . Yii::$app->user->identity->nick . ')', ['class' => 'nav-link btn btn-link logout text-black']) . Html::endForm() . '</li>');
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $items,
    ]);
    NavBar::end();

	?>
</header>

<main id="main" class="flex-shrink-0 mt-3" role="main">
	<div class="container">
		<?php if (!empty($this->params['breadcrumbs'])): ?>
			<?= Breadcrumbs::widget([
				'homeLink'=> [
					'label'=>'Inicio',
					'url'=>Url::toRoute(['usuarios/index'])
				],
				'links' => $this->params['breadcrumbs']]) ?>
		<?php endif ?>
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
	<div class="container">
		<div class="row text-muted">
			<div class="col-md-6 text-center text-md-start">&copy; Establecimientos Hosteleros <?= date('Y') ?></div>
			<div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
		</div>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
