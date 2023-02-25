<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\FileHelper;
use yii\helpers\Console;
define('STDOUT', fopen('php://stdout', 'w'));
class CopiaController extends Controller
{
    public function actionCreate()
    {   
        $backupPath = \Yii::getAlias('@app/backups');
        if (!file_exists($backupPath)) {
            FileHelper::createDirectory($backupPath);
        }

        $fileName = date('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupPath . '/' . $fileName;

        $db = \Yii::$app->db;
        $user = $db->username;
        $password = $db->password;
        $name = $db->dsn;

        $command = "mysqldump -u $user -p$password $name > $filePath";

        exec($command, $output, $return);

        if ($return === 0) {
            $this->stdout("La copia de seguridad se ha creado de manera correcta: $fileName");
        } else {
        $this->stdout(" Error al crear la copia de seguridad:". implode("\n", $output));
        }
    }
    public function actionRestore($archivo){
        $backupPath = \Yii::getAlias('@app/backups');
        $filePath = $backupPath . '/' . $archivo;

        $db = \Yii::$app->db;
        $user = $db->username;
        $password = $db->password;
        $name = $db->dsn;

        $command = "mysql -u $user -p$password $name > $filePath";

        exec($command, $output, $return);

        if ($return === 0) {
            $this->stdout("La copia de seguridad se ha restaurado de manera correcta");
        } else {
        $this->stdout(" Error al crear la copia de seguridad:". implode("\n", $output));
        }
    }
}
   
