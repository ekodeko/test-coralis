<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldResetTokenInTableUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'reset_token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
    
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'reset_token');
    }
}
