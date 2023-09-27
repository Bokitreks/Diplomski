<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $warehouseProducts = [
        [1,1,10],
        [2,1,10],
        [1,2,7],
        [1,3,7],
        [1,4,7],
        [1,5,7],
        [1,6,7],
    ];
        foreach($warehouseProducts as $warehouseProduct)
        DB::table('warehouse_products')->insert([
            'warehouse_id' => $warehouseProduct[0],
            'product_id' => $warehouseProduct[1],
            'quantity' => $warehouseProduct[2],
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
