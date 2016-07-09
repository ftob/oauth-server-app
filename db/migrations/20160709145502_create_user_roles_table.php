<?php

use Phinx\Migration\AbstractMigration;

class CreateUserRolesTable extends AbstractMigration
{
    public function up()
    {
        $userRoles = $this->table('users_roles', ['id' => false, 'primary' => ['user_identifier', 'role_id']]);

        $userRoles->addColumn('user_identifier', 'string', ['limit' => 100])
            ->addColumn('role_id', 'integer', ['limit' => 11])
            ->save();

        $this->table('users_roles')->addForeignKey('user_identifier', 'users', 'identifier')
            ->save();

        $this->table('users_roles')->addForeignKey('role_id', 'roles', 'id')
            ->save();


    }

    public function down()
    {
        if ($this->table('users_roles')->exists()) {
            $this->table('users_roles')->dropForeignKey('user_identifier')->save();
            $this->table('users_roles')->dropForeignKey('role_id')->save();
            $this->table('users_roles')->drop();
        }
    }
}
