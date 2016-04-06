<?php

use yii\db\Migration;

class m160406_192255_create_view_notices extends Migration
{
    public function up()
    {
        $this->createTable('view_notices', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'notice_id' => $this->integer(),
            'viewed' => $this->smallInteger()
        ]);
    }

    public function down()
    {
        $this->dropTable('view_notices');
    }
}
