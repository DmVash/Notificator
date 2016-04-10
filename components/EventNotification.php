<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.04.2016
 * Time: 19:59
 */

namespace app\components;


use yii\base\Event;
use yii\base\Component;

class EventNotification extends Event
{
    const SEND_NOTIFICATION = 'send-notification';
    public $lol;
    public $azaz;

}