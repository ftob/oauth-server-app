<?php

use Phinx\Migration\AbstractMigration;

class CreateAccessTokenTable extends AbstractMigration
{
    public function up()
    {
        $accessTokens = $this->table('access_token', ['id' => false, 'primary_key' => ['identifier']]);
        $accessTokens->addColumn('identifier', 'string', ['limit' => 100])
            ->addColumn('expiry_date_time', 'datetime')
            ->addColumn('user_identifier', 'string', ['limit' => 100])->save();
    }

    public function down()
    {
        $this->table('access_token');
    }
}
