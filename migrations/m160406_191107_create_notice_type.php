<?php

use yii\db\Migration;

class m160406_191107_create_notice_type extends Migration
{
    public function up()
    {
        $this->createTable('notice_type', [
            'id' => $this->primaryKey(),
            'code' => $this->integer(),
            'type' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('notice_type_table');
    }
}
