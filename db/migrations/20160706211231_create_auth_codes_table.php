<?php

use Phinx\Migration\AbstractMigration;

/**
 * Class CreateAuthCodesTable
 */
class CreateAuthCodesTable extends AbstractMigration
{
    public function up()
    {
        $authCodes = $this->table('auth_codes', ['id' => false, ['primary' => ['identifier']]]);
        $authCodes->addColumn('identifier', 'string', ['limit' => 100])
            ->addColumn('redirect_uri', 'string', ['limit' => 1024])
            ->addColumn('expiry_date_time', 'datetime')
            ->addColumn('user_identifier', 'string', ['limit' => 100])
            ->addColumn('client_identifier', 'string', ['limit' => 100])
            ->save()
        ;

        $authCodes->addIndex('identifier', array('unique' => true))->save();

    }

    public function down()
    {
        if ($this->table('auth_codes')->exists()) {
            $this->dropTable('auth_codes');
        }
    }
}
