<?php

namespace app\components;

use yii\base\Event;
use yii\base\Component;

class NotificationHandler extends Component
{
    const SEND_NOTIFICATION = 'send-notification';
    public static function handleNotification($event)
    {
        print_r($event->data['lol']);
        echo 'The notification has been successfully sent to the user' . $event->data->lol;
    }
}