<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sending_browser_notifications".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $sender_id
 * @property string $text
 * @property integer $user_id
 * @property array $type
 * @property integer $all_users
 *
 * @property Notifications $type0
 * @property ViewNotices[] $viewNotices
 */
class SendingNotifications extends \yii\db\ActiveRecord
{
    public $all_users;
    public $article_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sending_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'user_id', 'article_id'], 'integer'],
            [['code', 'title', 'text'], 'string', 'max' => 255],
            ['type', 'required', 'message' => 'Выберите тип уведомления'],
            ['all_users', 'boolean']
            //[['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notifications::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'РќР°Р·РІР°РЅРёРµ',
            'type_id' => 'Type ID',
            'sender_id' => 'Sender ID',
            'article_id' => 'Р’С‹Р±РѕСЂ СЃС‚Р°С‚СЊРё',
            'text' => 'Text',
            'user_id' => 'User ID',
            'type' => 'Type',
            'all_users' => 'Send to all users'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(Notifications::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewNotices()
    {
        return $this->hasMany(ViewNotices::className(), ['notice_id' => 'id']);
    }


    public function sendNotifications()
    {
        $params['notification_text'] = $this->text;
        $params['subject'] = $this->title;
        if(!$this->all_users){
            $params['user_id'] = $this->user_id;
            $params['username'] = User::findOne($this->user_id)->username;
            $params['email'] = User::findOne($this->user_id)->email;
        }
        $params['all_users'] = $this->all_users;
        if($this->code == 'posts') {
            $params['post_id'] = $this->article_id;
            $params['article_title'] = Posts::findOne($this->article_id)->title;
            $params['article_text'] = Posts::findOne($this->article_id)->text;
        }
        $params['sender'] = $this->sender_id;
        $params['code'] = $this->code;
        $params['generated'] = true;
        foreach($this->type as $type){
            switch($type) {
                case 'browser':
                    $this->on(NotificationHandler::SEND_GENERATED_NOTIFICATION, ['app\models\NotificationHandler', 'handleBrowserNotification'], $params);
                    break;
                case 'email':
                    $this->on(NotificationHandler::SEND_GENERATED_NOTIFICATION, ['app\models\NotificationHandler', 'handleEmailNotification'], $params);
                    break;
            }
        }
        $this->trigger(NotificationHandler::SEND_GENERATED_NOTIFICATION);

    }
}
