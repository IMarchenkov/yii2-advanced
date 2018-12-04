<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m181204_221852_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'event' => $this->string(60),
            'type' => $this->string(60),
            'recipient' => $this->string(),
            'subject' => $this->string(),
            'text' => $this->text(),
            'status' => $this->string(60),
            'error' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('message');
    }
}
