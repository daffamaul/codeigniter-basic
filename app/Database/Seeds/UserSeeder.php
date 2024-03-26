<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'daffa',
            'useremail' => 'daffa@gmail.com',
            'userpassword' => password_hash('@dffmln123', PASSWORD_BCRYPT),
        ];

        $this->db->table('users')->insert($data);
    }
}
