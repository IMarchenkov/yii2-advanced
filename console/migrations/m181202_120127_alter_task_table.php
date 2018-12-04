<?php

use yii\db\Migration;

/**
 * Class m181202_120127_alter_task_table
 */
class m181202_120127_alter_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_task_user', 'task');

        $this->renameColumn('task', 'date', 'date_start');
        $this->renameColumn('task', 'user_id', 'responsible_id');

        $this->addColumn('task', 'initiator_id', 'integer');
        $this->addColumn('task', 'project_id', 'integer');

        $this->addForeignKey('fk_task_responsible', 'task', 'responsible_id', 'user', 'id');
        $this->addForeignKey('fk_task_initiator', 'task', 'initiator_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_responsible', 'task');
        $this->dropForeignKey('fk_task_initiator', 'task');

        $this->renameColumn('task', 'date_start', 'date');
        $this->renameColumn('task', 'responsible_id', 'user_id');

        $this->dropColumn('task', 'initiator_id');
        $this->dropColumn('task', 'project_id');

        $this->addForeignKey('fk_task_user', 'task', 'user_id', 'user', 'id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181202_120127_alter_task_table cannot be reverted.\n";

        return false;
    }
    */
}
