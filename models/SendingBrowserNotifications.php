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
 * @property string $type
 *
 * @property Notifications $type0
 * @property ViewNotices[] $viewNotices
 */
class SendingBrowserNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sending_browser_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'user_id'], 'integer'],
            [['code', 'title', 'text', 'type'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'type_id' => 'Type ID',
            'sender_id' => 'Sender ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getType0()
    {
        return $this->hasOne(Notifications::className(), ['id' => 'type_id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewNotices()
    {
        return $this->hasMany(ViewNotices::className(), ['notice_id' => 'id']);
    }
}
