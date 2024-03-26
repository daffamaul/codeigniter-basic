<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTableUser extends Migration
{
    // protected $db = 'ci4_basic';

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'useremail' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'userpassword' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
