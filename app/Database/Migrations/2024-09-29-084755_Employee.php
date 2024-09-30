<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employee extends Migration


    {
        public function up()
        {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'position' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('employees');
        }
    
        public function down()
        {
            $this->forge->dropTable('employees');
        }
    }

