<?php

use yii\db\Migration;

/**
 * Handles the creation of table `roles`.
 */
class m181015_194438_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()
        ]);

        $this->createIndex('ix_roles_id', 'role', 'id', true);

        $this->addColumn('user', 'role_id', 'integer');
        $this->addForeignKey('fk_user_role', 'user', 'role_id', 'role', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('role');

        $this->dropColumn('user', 'role_id');
    }
}
