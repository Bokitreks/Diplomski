<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $materials = ['Drvo', 'Metal', 'PVC', 'Aluminijum', 'Staklo'];
        foreach($materials as $material)
        DB::table('materials')->insert([
            'material' => $material,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
