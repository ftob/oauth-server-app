<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        $users = $this->table('users', ['id' => false, 'primary' => ['identifier']]);
        $users->addColumn('identifier', 'string', ['limit' => 100])
            ->addColumn('username', 'string', ['limit' => 64])
            ->addColumn('password', 'string', ['limit' => 72])
            ->addColumn('salt', 'string', ['limit' => 64])
            ->save();
        $users->addIndex('identifier', array('unique' => true))->save();

    }

    public function down()
    {
        if ($this->table('users')->exists()) {
            $this->dropTable('users');
        }
    }
}
