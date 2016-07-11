<?php

use Phinx\Migration\AbstractMigration;

class CreateClientsTable extends AbstractMigration
{
    public function up()
    {
        $clients = $this->table('clients', ['id' => false, ['primary' => ['identifier']]]);
        $clients->addColumn('identifier', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 64])
            ->addColumn('redirect_uri', 'string')
            ->save();

        $clients->addIndex('identifier', array('unique' => true))->save();

    }

    public function down()
    {
        $this->dropTable('clients');
    }

}
