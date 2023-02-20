<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDigitalAsessts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('digital_asessts');

        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
        ]);

        $table->addColumn('image_id', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('license_type', 'enum', [ // generic, custom, etc
            'values' => ['generic', 'custom'],
            'null' => false,
        ]);
        
        $table->addColumn('license_info', 'string', [
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('owner_type', 'enum', [ // individual or  organisation
            'values' => ['individual', 'organisation'], 
            'null' => false,
        ]);

        $table->addColumn('owner_info', 'string', [ // owner information
            'null' => false,
        ]);
        

        $table->create();
    }
}
