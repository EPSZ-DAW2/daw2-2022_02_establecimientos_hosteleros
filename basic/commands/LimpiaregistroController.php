<?php
/**
 * Para ejecutar este controlador hay que ejecutar las siguiente linea en el terminal de windows
 * 0 3 * * * /usr/bin/php /direccion/a/tu/app/protected/yiic Limpiar
 * este comando indica que se va a ejecutar a las 3 de la mañana cada día
 */

namespace app\commands;

use app\models\Registro;
use yii\console\Controller;


class LimpiarController extends Controller {
    public function actionIndex() {
        $dia = date('Y-m-d', strtotime('-1 day'));
        $criterio = new CDbCriteria();
        $criterio->addCondition('fecha_registro <= :fecha');
        $criterio->params[':fecha'] = $dia;
        Registro::model()->deleteAll($criterio);
    }
}