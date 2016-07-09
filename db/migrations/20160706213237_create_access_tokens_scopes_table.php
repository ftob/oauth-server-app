<?php

use Phinx\Migration\AbstractMigration;

class CreateAccessTokensScopesTable extends AbstractMigration
{
    public function up()
    {
        $accessTokensScopes = $this->table('access_tokens_scopes', ['id' => false]);

        $accessTokensScopes->addColumn('access_token_identifier', 'string', ['limit' => 100])
            ->addColumn('scope_identifier', 'string', ['limit' => 100])
            ->save();

        $this->table('access_tokens_scopes')->addForeignKey('access_token_identifier', 'access_tokens', 'identifier')
            ->save();

        $this->table('access_tokens_scopes')->addForeignKey('scope_identifier', 'scopes', 'identifier')
            ->save();


    }

    public function down()
    {

        if ($this->table('access_tokens_scopes')->exists()) {
            $this->table('access_tokens_scopes')->dropForeignKey('access_token_identifier')->save();
            $this->table('access_tokens_scopes')->dropForeignKey('scope_identifier')->save();
            $this->table('access_tokens_scopes')->drop();
        }
    }
}
