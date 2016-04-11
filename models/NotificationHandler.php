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
        $text = NotificationHandler::getNotificationText($event->data['code']);

        $message = Yii::$app->mailer->compose();
        $message->setFrom(Yii::$app->params['adminEmail']);
        $message->setTo($event->data['email'])
            ->setSubject($event->data['subject'])
            ->setTextBody(NotificationHandler::replaceTextPattern($text, $event->data))
            ->send();
        //echo 'The notification has been successfully sent to the user' . $event->data['params'];
    }

    private function getNotificationText($code)
    {
        //return $text = $this->findOne(['code' => $code])->text;
        $notification = new Notifications();
        return $notification->getNotificationText($code);
    }

    private function replaceTextPattern($text, $params)
    {
    //Todo можно сделать получение набора шаблонов из базы
       $patterns = ['{username}','{sitename}','{articleName}','{shortText}'];
        $replacedText = '';
        //foreach($patterns as $pattern){

            if(strpos($text, '{username}'))
                $text = str_replace('{username}', $params['username'], $text);
            if(strpos($text, '{sitename}'))
                $text  = str_replace('{sitename}', Yii::$app->params['siteName'], $text);
                        //}

        return $text;
    }
}