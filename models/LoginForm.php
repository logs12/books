<?php
/**
 * LoginForm.php
 * @author: work
 */

namespace app\models;

use yii\base\Model;
use Yii;

class LoginForm extends Model
{
    public $username;

    public $password;

    public $email;

    public $rememberMe;

    public $status;

    private $_user = false;

    public function rules(){
        return[
            [['username', 'password'],'required', 'on' => 'default'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            //['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute){
        if (!$this->hasErrors()){
            $user = $this->getUser();
            if (!$user || $user->validatePassword($this->password))
                $this->addError($attribute,'Неправильное имя пользователя или пароль');
        }
    }

    public function getUser(){
        if($this->_user === false)
            $this->_user = User::findByUsername($this->username);
        return $this->_user;
    }

    public function attributeLabels(){
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }


    public function login(){
        if($this->validate()) {
            $this->status = ($user = $this->getUser()) ? $user->status : User::STATUS_NOT_ACTIVE;
            if ($this->status === User::STATUS_ACTIVE)
                return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            else
                return false;
        }
        else
            return false;
    }
}