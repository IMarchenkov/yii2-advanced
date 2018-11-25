<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents`.
 */
class m181028_175341_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'path' => $this->string(255),
            'user_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk_file_task', 'file', 'task_id', 'task', 'id');
        $this->addForeignKey('fk_file_user', 'file', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('file');
    }
}
