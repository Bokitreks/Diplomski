<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $roles = ['Customer', 'Admin'];
        foreach($roles as $role)
        DB::table('roles')->insert([
            'role' => $role,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
