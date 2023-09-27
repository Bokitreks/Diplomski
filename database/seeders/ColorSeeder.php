<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $colors = ['Crna', 'Bela', 'Siva', 'Plava', 'Zuta', 'Crvena', 'Braon', 'Bez', 'Ljubicasta', 'Narandzasta', 'Zelena', 'Teget'];
        foreach($colors as $color)
        DB::table('colors')->insert([
            'color' => $color,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
