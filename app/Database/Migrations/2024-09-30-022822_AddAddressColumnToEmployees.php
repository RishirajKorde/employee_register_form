<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAddressColumnToEmployees extends Migration
{
    public function up()
    {
        $this->forge->addColumn('employees', [
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true, // or false, depending on whether you want it to be nullable
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('employees', 'address');
    }
}
