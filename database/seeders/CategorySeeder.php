<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $categories = ['Sigurnosna vrata', 'Sobna vrata', 'PVC stolarija'];
        foreach($categories as $category)
        DB::table('categories')->insert([
            'category_name' => $category,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
