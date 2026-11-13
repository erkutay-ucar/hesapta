<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KeepOrdersWhenTableDeleted extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('orders', 'orders_table_id_foreign');

        $this->forge->modifyColumn('orders', [
            'table_id' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
        ]);

        $this->forge->addColumn('orders', [
            'table_name' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'after' => 'table_id'],
        ]);

        $this->forge->addForeignKey('table_id', 'restaurant_tables', 'id', '', 'SET NULL');
        $this->forge->processIndexes('orders');
    }

    public function down()
    {
        $this->forge->dropForeignKey('orders', 'orders_table_id_foreign');

        $this->forge->dropColumn('orders', 'table_name');

        $this->forge->modifyColumn('orders', [
            'table_id' => ['type' => 'INT', 'unsigned' => true, 'null' => false],
        ]);

        $this->forge->addForeignKey('table_id', 'restaurant_tables', 'id');
        $this->forge->processIndexes('orders');
    }
}
