<?php

namespace app\models;

use app\models\NotificationHandler;
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

        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            $params['username'] = $this->username;
            $params['email'] = $this->email;
            $params['title'] = 'Register';
            $params['code'] = 'signup';
            $params['sender'] = Yii::$app->user->id;
            $this->on(NotificationHandler::SEND_SIGNUP_NOTIFICATION, ['app\models\NotificationHandler', 'handleEmailNotification'], $params);
            $this->trigger(NotificationHandler::SEND_SIGNUP_NOTIFICATION);

            $user->save(false);

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