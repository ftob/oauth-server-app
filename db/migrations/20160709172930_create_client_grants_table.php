<?php

use Phinx\Migration\AbstractMigration;

class CreateClientGrantsTable extends AbstractMigration
{
    const TABLE = 'client_grants';

    public function up()
    {
        $clientGrants = $this->table(self::TABLE, ['id' => false]);
        $clientGrants->addColumn('client_identifier', 'string', ['limit' => 100])
            ->addColumn('grant_id', 'integer', ['limit' => 11])
            ->save();
        $clientGrants->addForeignKey('client_identifier', 'clients', 'identifier')->save();
        $clientGrants->addForeignKey('grant_id', 'grants', 'id')->save();
    }

    public function down()
    {
        $clientsGrants = $this->table(self::TABLE);
        if ($clientsGrants->exists()) {
            $clientsGrants->dropForeignKey('client_identifier')->save();
            $clientsGrants->dropForeignKey('grant_id')->save();
            $clientsGrants->drop();
        }
    }
}
