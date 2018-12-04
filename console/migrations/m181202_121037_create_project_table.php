<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m181202_121037_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256),
            'description' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('project');
    }
}
