<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $users = [['admin', md5('admin32199'), 'admin@gmail.com', 2]];
        foreach($users as $user)
        DB::table('users')->insert([
            'username' => $user[0],
            'password' => $user[1],
            'email' => $user[2],
            'role_id' => $user[3],
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
