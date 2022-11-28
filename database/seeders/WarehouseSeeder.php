<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $warehouses = ['Warehouse 1', 'Warehouse 2'];
        foreach($warehouses as $warehouse)
        DB::table('warehouses')->insert([
            'warehouse_name' => $warehouse,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
