<?php

use yii\db\Migration;

class m160406_135427_create_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string(),
            'pass' => $this->string(),
            'email' => $this->string(),
            'banned' => $this->smallInteger()
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
