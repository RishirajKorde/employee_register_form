<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDobcolumntoemployee extends Migration
{
    public function up()
    {
        $this->forge->addColumn('employees', [
            'dob' => [
                'type' => 'DATE',
                'null' => true, // or false, depending on whether you want it to be nullable
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('employees', 'dob');
    }
}
