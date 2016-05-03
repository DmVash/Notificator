<?php

use yii\db\Migration;

class m160503_145210_create_posts extends Migration
{
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->text(),
            'user_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-posts-user_id',
            'posts',
            'user_id'
        );

        $this->addForeignKey(
            'posts_ibfk_1',
            'posts',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'idx-posts-user_id',
            'posts'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'posts_ibfk_1',
            'posts'
        );

        $this->dropTable('posts');

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
