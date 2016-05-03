<?php

use yii\db\Migration;

class m160406_135427_create_view_notices extends Migration
{
    public function up()
    {
        $this->createTable('view_notices', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'notice_id' => $this->integer(),
            'viewed' => $this->smallInteger()
        ]);

        $this->createIndex(
            'idx-view_notices-user_id',
            'view_notices',
            'user_id'
        );

        $this->addForeignKey(
            'view_notices_ibfk_1',
            'view_notices',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-view_notices-notice_id',
            'view_notices',
            'notice_id'
        );

        $this->addForeignKey(
            'view_notices_ibfk_2',
            'view_notices',
            'notice_id',
            'sending_notifications',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'view_notices_ibfk_1',
            'view_notices'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-view_notices-user_id',
            'view_notices'
        );

        $this->dropForeignKey(
            'view_notices_ibfk_2',
            'view_notices'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-view_notices-notice_id',
            'view_notices'
        );
        $this->dropTable('view_notices');

    }
}
