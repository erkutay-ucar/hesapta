<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'restaurant_id' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'role'          => ['type' => 'VARCHAR', 'constraint' => 20],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'tc'            => ['type' => 'CHAR', 'constraint' => 11, 'null' => true],
            'username'      => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_active'     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['restaurant_id', 'tc']);
        $this->forge->addUniqueKey('username');
        $this->forge->addForeignKey('restaurant_id', 'restaurants', 'id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
