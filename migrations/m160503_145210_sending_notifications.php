<?php

use yii\db\Migration;

class m160503_145210_create_ending_notifications extends Migration
{
    public function up()
    {
        $this->createTable('sending_notifications', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'code' => $this->string(),
            'sender_id' => $this->integer(),
            'text' => $this->string(),
            'user_id' => $this->integer(),
            'type' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable('sending_notifications');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
