<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialSchema extends Migration
{
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

        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'role'          => ['type' => 'VARCHAR', 'constraint' => 20],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'tc'            => ['type' => 'CHAR', 'constraint' => 11],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_active'     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('tc');
        $this->forge->createTable('users');

        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('restaurant_tables');

        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');

        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'category_id' => ['type' => 'INT', 'unsigned' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 150],
            'description' => ['type' => 'TEXT', 'null' => true],
            'price'       => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'is_active'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->createTable('products');

        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'table_id'   => ['type' => 'INT', 'unsigned' => true],
            'user_id'    => ['type' => 'INT', 'unsigned' => true],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'preparing'],
            'is_closed'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['table_id', 'is_closed']);
        $this->forge->addForeignKey('table_id', 'restaurant_tables', 'id');
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('orders');

        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'order_id'     => ['type' => 'INT', 'unsigned' => true],
            'product_id'   => ['type' => 'INT', 'unsigned' => true],
            'quantity'     => ['type' => 'INT', 'unsigned' => true, 'default' => 1],
            'unit_price'   => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'note'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_cancelled' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id');
        $this->forge->addForeignKey('product_id', 'products', 'id');
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->forge->dropTable('order_items');
        $this->forge->dropTable('orders');
        $this->forge->dropTable('products');
        $this->forge->dropTable('categories');
        $this->forge->dropTable('restaurant_tables');
        $this->forge->dropTable('users');
        $this->forge->dropTable('settings');
    }
}
