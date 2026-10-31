<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKitchenPinToRestaurants extends Migration
{
    public function up()
    {
        $this->forge->addColumn('restaurants', [
            'kitchen_pin_hash' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'phone'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('restaurants', 'kitchen_pin_hash');
    }
}
