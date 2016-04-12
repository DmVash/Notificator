<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property string $code
 * @property string $type
 * @property string $text
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'string'],
            [['text'], 'string'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'type' => 'Type',
            'text' => 'Text',
        ];
    }

    public static function getNotificationText($code)
    {
        return static::findOne(['code' => $code])->text;
    }


}
