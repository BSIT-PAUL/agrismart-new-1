<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'User_ID'=>"2",
            'Username'=>"Admin",
            'Password'=> password_hash("dec212002",PASSWORD_BCRYPT),
        );
        $this->db->table('user_login')->insert($data);
    }
}
