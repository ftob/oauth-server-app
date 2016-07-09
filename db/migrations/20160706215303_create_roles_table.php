<?php

use Phinx\Migration\AbstractMigration;

class CreateRolesTable extends AbstractMigration
{
    public function up()
    {
        $roles = $this->table('roles');

        $roles->addColumn('role', 'string', ['limit' => 32])
            ->save();
    }

    public function down()
    {
        if ($this->table('roles')->exists()) {
            $this->dropTable('roles');
        }
    }
}
