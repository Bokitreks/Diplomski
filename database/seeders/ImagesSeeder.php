<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $images = [[1, 'assets/images/products/Door1.jpg', 'Sobna vrata'],[2, 'assets/images/products/Door6.jpg', 'Sigurnosna vrata'],
        [3, 'assets/images/products/Door19.jpg', 'Sigurnosna vrata'],[4, 'assets/images/products/Door34.jpg', 'Sigurnosna vrata'],
        [5, 'assets/images/products/PVC1.jpg', 'PVC Stolarija'],[6, 'assets/images/products/PVC2.jpg', 'PVC Stolarija']];
        foreach($images as $image)
        DB::table('images')->insert([
            'product_id' => $image[0],
            'href' => $image[1],
            'alt' => $image[2],
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
