<?php

namespace app\models;

use app\components\NotificationHandler;
use app\components\EventNotification;
use app\models\User;
use yii\base\Model;
use Yii;

class SignupForm extends  Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            //['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            //['email', 'filter', 'filter' => 'trim'],
            //['email', 'required'],
            //['email', 'email'],
            ['email', 'string', 'max' => 255],
            //['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            //['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        $arr = ['lol'=>'rrr', 'azaz' => 'rr'];

        $arr = ['lol'=>'rrr', 'azaz' => 'rr'];
        $this->on(NotificationHandler::SEND_NOTIFICATION,['app\components\NotificationHandler','handleNotification'], $arr);

        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;

            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();


            $this->trigger(NotificationHandler::SEND_NOTIFICATION);exit;
            //Yii::$app->user->trigger(EventNotification::SEND_NOTIFICATION, new EventNotification($arr));exit;
            $user->save(false);

            // нужно добавить следующие три строки:
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign($authorRole, $user->getId());

            return $user;
        }

        return null;

       /* if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('user');
        print_r($user->getId());exit;
        $auth->assign($userRole, $user->getId());

        return $user->save() ? $user : null;*/
    }
}