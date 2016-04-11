<?php

namespace app\models;

//use yii\base\Event;
use Yii;
use yii\base\Component;

class NotificationHandler extends Component
{
    const SEND_EMAIL_NOTIFICATION = 'send-email-notification';

    /**
     * Todo:необходимо передавать параметр сообщения(заголовок, текст), если параметры не переданы, то использовать стандартное сообщение о регистрации,
     * @param $event
     */

    public static function handleEmailNotification($event)
    {
        $message = Yii::$app->mailer->compose();
        $message->setFrom('from@domain.com');
        $message->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->send();
        //echo 'The notification has been successfully sent to the user' . $event->data['params'];
    }
}