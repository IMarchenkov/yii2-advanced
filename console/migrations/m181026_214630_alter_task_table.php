<?php

use yii\db\Migration;

/**
 * Class m181026_214630_alter_task_table
 */
class m181026_214630_alter_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'date_end', 'datetime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task', 'date_end');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181026_214630_alter_task_table cannot be reverted.\n";

        return false;
    }
    */
}
