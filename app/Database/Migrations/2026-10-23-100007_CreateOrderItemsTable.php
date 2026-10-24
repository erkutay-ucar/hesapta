<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
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
    }
}
