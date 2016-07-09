<?php

use Phinx\Migration\AbstractMigration;

class CreateGrantsTable extends AbstractMigration
{
    const TABLE = 'grants';
    public function up()
    {
        $grants = $this->table(self::TABLE);
        $grants->addColumn('name', 'string', ['limit' => 16])
            ->save();

        $grants->addIndex('name', array('unique' => true))->save();
    }


    public function down()
    {
        if ($this->table(self::TABLE)->exists()) {
            $this->table(self::TABLE)->drop();
        }
    }
}
