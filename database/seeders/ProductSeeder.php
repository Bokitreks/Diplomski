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
        $products = [['Sobna vrata zeus', 'Klasicna sobna vrata od drveta', 1, 2, 1, 18000], ['Protecta SN', 'Sigurnosna vrata visokog kvaliteta', 7, 1, 1, 21000],
        ['Platinum Secure', 'Veoma izdrzljiva i pouzdana', 1, 1, 1, 19500], ['Hotel maximum', 'Sigurnosna vrata za hotelske sobe', 7, 1, 2, 17600]
        , ['PVC klasik', 'Osnovna varijanta PVC prozora', 2, 3, 3, 9800], ['PVC plus', 'PVC prozor sa ojacanim ramom', 2, 3, 2, 12500]];
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
