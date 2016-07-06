<?php

use Phinx\Migration\AbstractMigration;

class CreateClientsTable extends AbstractMigration
{
    public function up()
    {
        $clients = $this->table('clients', ['id' => false, ['primary' => ['identifier']]]);
        $clients->addColumn('name', 'string', ['limit' => 64])
            ->addColumn('redirect_uri', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('clients');
    }

}
