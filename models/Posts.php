<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Posts';
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
        ];
    }
}
