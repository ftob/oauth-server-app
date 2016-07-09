<?php

use Phinx\Migration\AbstractMigration;

class CreateRefreshTokenTable extends AbstractMigration
{
    public function up()
    {
        $refreshTokens = $this->table('refresh_tokens', ['id' => false, ['primary' => ['identifier']]]);
        $refreshTokens->addColumn('identifier', 'string', ['limit' => 100])
            ->addColumn('expiry_date_time', 'datetime')
            ->addColumn('access_token_identifier', 'string', ['limit' => 100])
            ->save();
        $refreshTokens->addIndex('identifier', array('unique' => true))->save();

    }

    public function down()
    {
        if ($this->table('refresh_tokens')->exists()) {
            $this->dropTable('refresh_tokens');
        }
    }

}
