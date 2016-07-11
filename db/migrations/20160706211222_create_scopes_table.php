<?php

use Phinx\Migration\AbstractMigration;

class CreateScopesTable extends AbstractMigration
{
    public function up()
    {
        $scopes = $this->table('scopes',  ['id' => false, ['primary' => ['identifier']]]);

        $scopes->addColumn('identifier', 'string', ['limit' => 100])
            ->addColumn('description', 'string', ['limit' => 4096])
            ->save();

        $scopes->addIndex('identifier', array('unique' => true))->save();
    }

    public function down()
    {
        if ($this->table('scopes')->exists()) {
            $this->dropTable('scopes');
        }
    }
}
