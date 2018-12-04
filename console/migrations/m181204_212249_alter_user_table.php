<?php

use yii\db\Migration;

/**
 * Class m181204_212249_alter_user_table
 */
class m181204_212249_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'telegram_id', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user', 'telegram_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181204_212249_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
