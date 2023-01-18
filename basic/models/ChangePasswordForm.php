<?php

namespace app\models;
use yii\base\Model;
use Yii;

class ChangePasswordForm extends Model
{
public $password;
public $password_repeat;

    public function rules()
    {
        return [
                [['password', 'password_repeat'], 'required'],
                ['password', 'string', 'min' => 6],
                ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden'],
            ];
    }
}