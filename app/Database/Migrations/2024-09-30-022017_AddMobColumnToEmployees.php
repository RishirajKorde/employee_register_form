<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMobColumnToEmployees extends Migration
{
    public function up()
    {
        $this->forge->addColumn('employees', [
            'mob' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true, // or false, depending on whether you want it to be nullable
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('employees', 'mob');
    }
}
