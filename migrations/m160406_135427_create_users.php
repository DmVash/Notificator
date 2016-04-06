<?php

use yii\db\Migration;

class m160406_135427_create_users extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string(),
            'pass' => $this->string(),
            'email' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
