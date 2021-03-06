<?php

namespace app\models;

//use yii\base\Event;
use yii\helpers\Url;
use Yii;
use yii\base\Component;
use yii\helpers\Html;
class NotificationHandler extends Component
{

    const SEND_SIGNUP_NOTIFICATION = 'send-signup-notification';
    const SEND_POST_NOTIFICATION = 'send-posts-notification';
    const SEND_GENERATED_NOTIFICATION = 'send-generated-notification';
    const SEND_BAN_NOTIFICATION = 'send-ban-notification';


    /**
     *
     * @param $event
     */

    public static function handleEmailNotification($event)
    {
        $params = $event->data;
        $usersData = self::getUsersData();
        if (!$params['generated'])
            $params['notification_text'] = self::getNotificationText($params['code']);
        $params['type'] = 'email';

        if ($event->data['all_users']) {
            $email = $usersData['email'];
            $params['ids'] = $usersData['id'];
            self::massEmailSend($usersData, $params);
            self::saveAllNotifications($usersData, $params);
        } else {
            $email = $params['email'];
            self::emailSend($params);
            self::saveNotification($params);
        }

    }

    public static function handleBrowserNotification($event)
    {
        $params = $event->data;
        $usersData = self::getUsersData();
        if (!$params['generated'])
            $params['notification_text'] = self::getNotificationText($params['code']);
        $params['type'] = 'browser';

        if ($params['all_users']) {
            $params['ids'] = $usersData['id'];
            self::saveAllNotifications($usersData, $params);
        } else {
            //$event->data['id']
            self::saveNotification($params);
        }
    }

    public function massEmailSend($users, $params)
    {
        foreach ($users as $user) {
            $message = Yii::$app->mailer->compose();
            $message->setFrom(Yii::$app->params['adminEmail']);
            $message->setTo($user['email'])
                ->setSubject(self::replaceTitlePattern($params['username'], $params))
                ->setTextBody(self::replaceTextPattern($user['username'], $params))
                ->send();
        }

    }


    public function emailSend($params)
    {
        $message = Yii::$app->mailer->compose();
        $message->setFrom(Yii::$app->params['adminEmail']);
        $message->setTo($params['email'])
            ->setSubject(self::replaceTitlePattern($params['username'], $params))
            ->setTextBody(self::replaceTextPattern($params['username'], $params))
            ->send();
    }


    private function saveAllNotifications($users, $params)
    {

        foreach ($users as $key => $user) {
            $rows[$key]['title'] = self::replaceTitlePattern($params['username'], $params);
            $rows[$key]['code'] = $params['code'];
            $rows[$key]['sender_id'] = $params['sender'];
            $rows[$key]['text'] = self::replaceTextPattern($user['username'], $params);
            $rows[$key]['user_id'] = $user['id'];
            $rows[$key]['type'] = $params['type'];
        }
        Yii::$app->db->createCommand()->batchInsert(SendingNotifications::tableName(), ['title', 'code', 'sender_id', 'text', 'user_id', 'type'], $rows)->execute();
    }

    private function saveNotification($params)
    {
        $browserNotification = new SendingNotifications([
            'title' => self::replaceTitlePattern($params['username'], $params),
            'code' => $params['code'],
            'sender_id' => $params['sender'],
            'text' => self::replaceTextPattern($params['username'], $params),
            'user_id' => $params['user_id'],
            'type' => $params['type']
        ]);
        $browserNotification->save(false);
    }

    private function getNotificationText($code)
    {
        //return $text = $this->findOne(['code' => $code])->text;
        $notification = new Notifications();
        return $notification->getNotificationText($code);
    }

    private function replaceTextPattern($username, $params)
    {
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
                    $text = str_replace($pattern, $params['article_title'], $text);
                    break;
                case '{shortText}':
                    $text = str_replace($pattern, self::getShortArticleText($params['article_text']), $text);
                    break;
                case '{link}':
                    $text = str_replace($patterns, Url::to(['@web/post/view', 'id' => $params['post_id']], true), $text);
                    break;

            }
        }

        return $text;
    }

    private function replaceTitlePattern($username, $params)
    {
        $patterns = ['{username}', '{sitename}', '{articleName}'];
        $text = $params['subject'];
        foreach ($patterns as $pattern) {
            switch ($pattern) {
                case '{username}':
                    $text = str_replace($pattern, $username, $text);
                    break;
                case '{sitename}':
                    $text = str_replace($pattern, Yii::$app->params['siteName'], $text);
                    break;
                case '{articleName}':
                    $text = str_replace($pattern, $params['article_title'], $text);
                    break;
            }
        }

        return $text;

    }

    private function getShortArticleText($text)
    {
        if (!empty($text)) {
            $short = substr($text, 0, strpos($text, ' ', 10));
            return $short . '...';
        }
    }

    public function getUsersData()
    {
        $data = [];
        $rows = (new \yii\db\Query())
            ->select(['id', 'email', 'username'])
            ->from('user')
            ->all();
        foreach ($rows as $row) {
            $data['email'][] = $row['email'];
            $data['id'][] = $row['id'];
            $data['username'][] = $row['username'];
        }

        return $rows;

    }
}