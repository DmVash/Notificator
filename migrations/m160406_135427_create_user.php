<?php

use yii\db\Migration;

class m160406_135427_create_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'pass' => $this->string(),
            'email' => $this->string(),
            'auth_key' => $this->string(),
            'status' => $this->integer()
        ]);
    }

    public function down()
    {        $this->dropTable('user');
    }
}
