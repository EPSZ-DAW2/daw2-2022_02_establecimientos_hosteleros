<?php
/** @var yii\web\View $this */
use \app\models\Hostelero;

$this->title = 'Listado Locales';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php echo $this->render('_patrocinados',['localespat'=>$localespat,]);?>

<h1>
    <?php
    if(Yii::$app->request->get('id')) {
		$hostelero = Hostelero::findOne(['id' => Yii::$app->request->get('id')]);
		if (isset($hostelero)) {
			$usuario = $hostelero->getUsuario()->one();
			echo 'Listado de locales del hostelero ' . $usuario->nombre . " " . $usuario->apellidos;
		} else {
			echo 'No existe el hostelero indicado';
			return 0;
		}
	}else
        echo 'Listado de locales';
    ?>
</h1>

<div class="container">
    <div class="row">
		<?php
        foreach ($locales as $local){
            echo $this->render('ficha_resumida', ['local'=>$local]);
        }
        ?>
    </div>
</div>

