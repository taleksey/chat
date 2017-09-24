<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 *
 * Class m170920_121346_create_user_table
 */
class m170920_121346_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'nick' => $this->string()->notNull()->unique(),
            'ip' => $this->string(),
            'city' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
