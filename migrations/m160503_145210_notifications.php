<?php

use yii\db\Migration;

class m160503_145210_create_notifications extends Migration
{
    public function up()
    {
        $this->createTable('notifications', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'type' => $this->string(),
            'text' => $this->text(),
        ]);
    }

    public function down()
    {
        $this->dropTable('notifications');

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
