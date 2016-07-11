<?php

use Phinx\Migration\AbstractMigration;

class CreateGrantsScopesTable extends AbstractMigration
{
    const TABLE = 'grants_scopes';

    public function up()
    {
        $grantsScopes = $this->table(self::TABLE, ['id' => false]);

        $grantsScopes->addColumn('grant_id', 'integer', ['limit' => 11])
            ->addColumn('scope_identifier', 'string', ['limit' => 100])
            ->save();

        $grantsScopes->addForeignKey('grant_id', 'grants', 'id')->save();
        $grantsScopes->addForeignKey('scope_identifier', 'scopes', 'identifier')->save();
    }

    public function down()
    {
        $grantsScopes = $this->table(self::TABLE);

        if ($grantsScopes->exists()) {
            $grantsScopes->dropForeignKey('grant_id')->save();
            $grantsScopes->dropForeignKey('scope_identifier')->save();

            $grantsScopes->drop();
        }
    }
}
