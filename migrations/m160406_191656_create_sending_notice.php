<?php

use yii\db\Migration;

class m160406_191656_create_sending_notice extends Migration
{
    public function up()
    {
        $this->createTable('sending_notice', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'type_id' => $this->integer(),
            'sender_id'=> $this->integer(),
            'text'=>$this->string(),
            'user_id' => $this->integer(),
            'date' =>$this->timestamp()
        ]);
    }

    public function down()
    {
        $this->dropTable('sending_notice');
    }
}
