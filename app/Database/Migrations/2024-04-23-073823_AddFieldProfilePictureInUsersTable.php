<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldProfilePictureInUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'profile_picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
    
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'profile_picture');
    }
}
