<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chat`.
 * Class m170920_123144_create_chat_table
 */
class m170920_123144_create_chat_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'message' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_date' => $this->timestamp(),
        ]);

        $this->createIndex(
            'idx-chat-user_id',
            'chat',
            'user_id'
        );

        $this->addForeignKey(
            'fk-chat-user_id',
            'chat',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-chat-user_id',
            'chat'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-chat-user_id',
            'chat   '
        );

        $this->dropTable('chat');
    }
}
