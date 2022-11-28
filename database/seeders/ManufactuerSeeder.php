<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufactuerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $manufacturers = ['Talaris', 'Altos', 'Bosal'];
        foreach($manufacturers as $manufacturer)
        DB::table('manufacturers')->insert([
            'manufacturer_name' => $manufacturer,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
