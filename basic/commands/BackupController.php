<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\FileHelper;
use yii\helpers\Console;
class BackupController extends Controller
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
            $this->stdout(" Error al crear la copia de seguridad: $output");
        }
    }
}
   