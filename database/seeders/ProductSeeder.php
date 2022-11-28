<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $products = [['Home door classic', 'Sobna vrata Talaris', 1, 2, 1, 18000], ['Securitas', 'Sigurnosna vrata Talaris', 1, 1, 1, 21000]];
        foreach($products as $product)
        DB::table('products')->insert([
            'title' => $product[0],
            'description' => $product[1],
            'color_id' => $product[2],
            'category_id' => $product[3],
            'manufacturer_id' => $product[4],
            'price' => $product[5],
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
