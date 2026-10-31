<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConvertToSingleRestaurant extends Migration
{
    private $tablolar = ['users', 'restaurant_tables', 'categories', 'products', 'orders'];

    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'restaurant_name'  => ['type' => 'VARCHAR', 'constraint' => 150],
            'address'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone'            => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'kitchen_pin_hash' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');

        foreach ($this->tablolar as $tablo) {
            $this->forge->dropForeignKey($tablo, $tablo . '_restaurant_id_foreign');
        }

        $this->forge->dropKey('users', 'restaurant_id_tc');

        foreach ($this->tablolar as $tablo) {
            $this->forge->dropColumn($tablo, 'restaurant_id');
        }

        $this->forge->dropColumn('users', 'username');

        $this->forge->addUniqueKey('tc');
        $this->forge->processIndexes('users');

        $this->forge->dropTable('restaurants');
    }

    public function down()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 150],
            'address'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone'            => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'kitchen_pin_hash' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('restaurants');

        $this->forge->dropKey('users', 'tc');

        foreach ($this->tablolar as $tablo) {
            $this->forge->addColumn($tablo, [
                'restaurant_id' => ['type' => 'INT', 'unsigned' => true, 'null' => true, 'after' => 'id'],
            ]);

            $this->forge->addForeignKey('restaurant_id', 'restaurants', 'id');
            $this->forge->processIndexes($tablo);
        }

        $this->forge->addColumn('users', [
            'username' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'after' => 'tc'],
        ]);

        $this->forge->addUniqueKey(['restaurant_id', 'tc']);
        $this->forge->addUniqueKey('username');
        $this->forge->processIndexes('users');

        $this->forge->dropTable('settings');
    }
}
