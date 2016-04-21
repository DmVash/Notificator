<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_notices".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $notice_id
 * @property integer $viewed
 *
 * @property User $user
 * @property SendingNotifications $notice
 */
class ViewedNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_notices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'notice_id', 'viewed'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'notice_id' => 'Notice ID',
            'viewed' => 'Viewed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotice()
    {
        return $this->hasOne(SendingNotifications::className(), ['id' => 'notice_id']);
    }
}
