<?php

use yii\db\Migration;

/**
 * Class m181024_191503_alter_task_table
 */
class m181024_191503_alter_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'created_at', 'datetime');
        $this->addColumn('task', 'updated_at', 'datetime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task', 'created_at');
        $this->dropColumn('task', 'updated_at');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181024_191503_alter_task_table cannot be reverted.\n";

        return false;
    }
    */
}
