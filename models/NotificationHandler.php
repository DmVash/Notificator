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


    /**
     * Todo:сделать выбор email для отрпавки, реализовать массовую отправку соощбщений,
     * @param $event
     */

    public static function handleEmailNotification($event)
    {
        $params = $event->data;
        $usersData = NotificationHandler::getUsersEmailAnId();
        $params['notification_text'] = NotificationHandler::getNotificationText($event->data['code']);
        $params['type'] = 'email';

        if ($event->data['all_users']) {
            $email = $usersData['email'];
            $params['ids'] = $usersData['id'];

            NotificationHandler::saveAllNotifications($params);
        } else {
            $email = $event->data['email'];//Todo изменить для формы создания уведомлений для получения email по ID
            NotificationHandler::saveNotification($params);
        }


        $message = Yii::$app->mailer->compose();
        $message->setFrom(Yii::$app->params['adminEmail']);
        $message->setTo($email)
            ->setSubject($params['title'])
            ->setTextBody(NotificationHandler::replaceTextPattern($params))
            ->send();
    }

    public function processSendEmail($email, $subject, $username, $other)
    {
        $message = Yii::$app->mailer->compose();
        $message->setFrom(Yii::$app->params['adminEmail']);
        $message->setTo($email)
            ->setSubject($subject)
            ->setTextBody(NotificationHandler::replaceTextPattern2($username,$other))
            ->send();
    }

    public static function handleBrowserNotification($event)
    {
        $params = $event->data;
        $usersData = NotificationHandler::getUsersEmailAnId();
        $params['notification_text'] = NotificationHandler::getNotificationText($params['code']);
        $params['type'] = 'browser';

        if ($params['all_users']) {
            $params['ids'] = $usersData['id'];
            NotificationHandler::saveAllNotifications($params);
           /* foreach ($ids as $key => $id) {
                $rows[$key]['title'] = $event->data['title'];
                $rows[$key]['code'] = $event->data['code'];
                $rows[$key]['sender_id'] = $event->data['sender'];
                $rows[$key]['text'] = NotificationHandler::replaceTextPattern($text, $event->data);
                $rows[$key]['user_id'] = $id;
                Yii::$app->db->createCommand()->batchInsert(SendingNotifications::tableName(), ['title', 'code', 'sender_id', 'text', 'user_id', 'type'], $rows)->execute();
            }*/
        } else {
            //$event->data['id'] Todo: будет подставляться ID указаный на форме создания уведомлений
           /* $browserNotification = new SendingNotifications([
                'title' => $event->data['title'],
                'code' => $event->data['code'],
                'sender_id' => $event->data['sender'],
                'text' => $event->data['text'],
                'user_id' => '2'
            ]);
            $browserNotification->save();*/
            NotificationHandler::saveNotification($params);
        }


    }

    private function saveAllNotifications($params)
    {

        foreach ($params['ids'] as $key => $id) {
            $rows[$key]['title'] = $params['title'];
            $rows[$key]['code'] = $params['code'];
            $rows[$key]['sender_id'] = $params['sender'];
            $rows[$key]['text'] = NotificationHandler::replaceTextPattern($params);
            $rows[$key]['user_id'] = $id;
            $rows[$key]['type'] = $params['type'];
        }
        Yii::$app->db->createCommand()->batchInsert(SendingNotifications::tableName(), ['title', 'code', 'sender_id', 'text', 'user_id', 'type'], $rows)->execute();
    }

    private function saveNotification($params)
    {
        $browserNotification = new SendingNotifications([
            'title' => $params['title'],
            'code' => $params['code'],
            'sender_id' => $params['sender'],
            'text' => $params['text'],
            'user_id' => '2' //Todo: будет подставляться ID указаный на форме создания уведомлений
        ]);
        $browserNotification->save();
    }

    private function getNotificationText($code)
    {
        //return $text = $this->findOne(['code' => $code])->text;
        $notification = new Notifications();
        return $notification->getNotificationText($code);
    }

    private function replaceTextPattern2($username, $params)
    {
        //Todo можно сделать получение набора шаблонов из базы
        $patterns = ['{username}', '{sitename}', '{articleName}', '{shortText}', '{link}'];
        $text = $params['notification_text'];
        foreach ($patterns as $pattern) {
            switch ($pattern) {
                case '{username}':
                    $text = str_replace($pattern, $username, $text);
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

    private function replaceTextPattern($params)
    {
        //Todo можно сделать получение набора шаблонов из базы
        $patterns = ['{username}', '{sitename}', '{articleName}', '{shortText}', '{link}'];
        $text = $params['notification_text'];
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

    public function getUsersEmailAnId()
    {
        $data = [];
        $rows = (new \yii\db\Query())
            ->select(['id', 'email'])
            ->from('user')
            ->all();
        foreach ($rows as $row) {
            $data['email'][] = $row['email'];
            $data['id'][] = $row['id'];
        }

        return $data;

    }
}