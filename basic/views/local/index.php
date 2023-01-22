<?php
/** @var yii\web\View $this */
use \app\models\Hostelero;
use \app\models\Zonas;
use yii\helpers\Html;
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
<?php
function mostrarZonas($padre_id = 0, $n=10)
{
$zonas = Zonas::find()->where(['zona_id' => $padre_id])->all();
$arbol = '';

foreach ($zonas as $zona) {
$arbol .= '<details>';
    $arbol .= '<summary style="text-indent:'. $n*10 .'px;"> '. Html::a($zona->nombre, ['index','zona'=>$zona->id], [
        'data' => [
        'method' => 'post',
        ],
        ]).'</summary>';

    $arbol .= mostrarZonas($zona->id,$n+1);
    $arbol .= '</details>';
}



return $arbol;
}?>
<?php $lista=mostrarZonas();
echo '<details><summary>Búsqueda por zona</summary>';
echo $lista;
echo '</details>';
?>

<div class="container">
    <div class="row">
		<?php
        foreach ($locales as $local){
            echo $this->render('ficha_resumida', ['local'=>$local]);
        }
        ?>
    </div>
</div>

