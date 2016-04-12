<?php

namespace app\models;

//use yii\base\Event;
use yii\helpers\Url;
use Yii;
use yii\base\Component;

class NotificationHandler extends Component
{
    //const SEND_EMAIL_NOTIFICATION = 'send-email-notification';
    //const SEND_BROWSER_NOTIFICATION = 'send-browser-notification';
    const SEND_SIGNUP_NOTIFICATION = 'send-signup-notification';
    const SEND_POST_NOTIFICATION = 'send-posts-notification';

    public $browserNoticeType = 'browser';
    public $emailNoticeType = 'email';
    public $patterns = [
        '{username}', '{sitename}', '{articleName}', '{shortText}', '{link}'
    ];

    /**
     * Todo:сделать выбор email для отрпавки, реализовать массовую отправку соощбщений,
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

    public static function handleBrowserNotification($event)
    {
        $browserNotification = new SendingBrowserNotifications([
            'title' => $event->data['title'],
            'code' => $event->data['code'],
            'sender_id' => Yii::$app->user->id,//Todo изменить на динамический id
            'text' => $event->data['text'],
        ]);
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
        $patterns = ['{username}', '{sitename}', '{articleName}', '{shortText}', '{link}'];

        foreach($patterns as $pattern){
            switch($pattern){
                case '{username}':
                    $text = str_replace($pattern, $params['username'], $text);
                    break;
                case '{sitename}':
                    $text = str_replace($pattern, Yii::$app->params['siteName'], $text);
                    break;
                case '{articleName}':
                    $text = str_replace($pattern, $params['title'], $text);
                    break;
                case '{shortText}':
                    $text = str_replace($pattern, NotificationHandler::getShortArticleText($params['text']), $text);
                    break;
                case '{link}':
                    $text = str_replace($patterns, Url::to(['@web/post/view', 'id' => $params['post_id']], true), $text);
                    break;

            }
        }

        return $text;
    }

    private function getShortArticleText($text)
    {
        return substr($text, 0, strpos($text, ' ', 20));
    }

    public function replaceLink()
    {

    }
}