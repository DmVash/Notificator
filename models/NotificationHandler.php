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

        if ($event->data['all_users'])
            $email = NotificationHandler::getUsersEmailAnId('email');
        else
            $email = $event->data['email'];//Todo изменить для формы создания уведомлений для получения email по ID

        $text = NotificationHandler::getNotificationText($event->data['code']);

        $message = Yii::$app->mailer->compose();
        $message->setFrom(Yii::$app->params['adminEmail']);
        $message->setTo($email)
            ->setSubject($event->data['subject'])
            ->setTextBody(NotificationHandler::replaceTextPattern($text, $event->data))
            ->send();
    }

    public static function handleBrowserNotification($event)
    {
        $text = NotificationHandler::getNotificationText($event->data['code']);

        if ($event->data['all_users']) {
            $ids = NotificationHandler::getUsersEmailAnId('id');

            foreach ($ids as $key => $id) {
                $rows[$key]['title'] = $event->data['title'];
                $rows[$key]['code'] = $event->data['code'];
                $rows[$key]['sender_id'] = Yii::$app->user->id;
                $rows[$key]['text'] = NotificationHandler::replaceTextPattern($text, $event->data);
                $rows[$key]['user_id'] = $id;
                Yii::$app->db->createCommand()->batchInsert(SendingBrowserNotifications::tableName(), ['title', 'code', 'sender_id', 'text', 'user_id'], $rows)->execute();
            }
        } else {
            $browserNotification = new SendingBrowserNotifications([
                'title' => $event->data['title'],
                'code' => $event->data['code'],
                'sender_id' => Yii::$app->user->id,
                'text' => $event->data['text'],
                'user_id' => '2' //Todo: будет подставляться ID указаный на форме создания уведомлений
            ]);
            $browserNotification->save();
        }


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

        foreach ($patterns as $pattern) {
            switch ($pattern) {
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

    public function getUsersEmailAnId($param)
    {
        $data = [];
        $rows = (new \yii\db\Query())
            ->select(['id', 'email'])
            ->from('user')
            ->all();
        foreach ($rows as $row) {
            $data[] = $row[$param];
        }

        return $data;

    }
}