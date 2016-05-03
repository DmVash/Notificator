<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $user_id
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'user_id' => 'User ID'
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $params['post_id'] = $this->id;
        $params['article_title'] = $this->title;
        $params['article_text'] = $this->text;
        $params['username'] = User::findOne($this->user_id)->username;
        $params['code'] = 'posts';
        $params['sender'] = $this->user_id;
        $params['all_users'] = 1;
        $params['subject'] = 'New article';
        $this->on(NotificationHandler::SEND_POST_NOTIFICATION, ['app\models\NotificationHandler', 'handleEmailNotification'], $params);
        $this->on(NotificationHandler::SEND_POST_NOTIFICATION, ['app\models\NotificationHandler', 'handleBrowserNotification'], $params);
        $this->trigger(NotificationHandler::SEND_POST_NOTIFICATION);
        parent::afterSave($insert, $changedAttributes);
    }

}
