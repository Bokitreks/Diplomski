<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $materials = [[1,2],[1,1],[2,2],[2,3],[3,2],[4,2],[5,1],[6,2]];
        foreach($materials as $material)
        DB::table('product_materials')->insert([
            'product_id' => $material[0],
            'material_id' => $material[1],
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
