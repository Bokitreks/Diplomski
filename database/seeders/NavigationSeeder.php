<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $navigations = [['Pocetna','home'],['Proizvodi','products'],['O nama','about'],['Kontak','contact']];
        foreach($navigations as $navigation)
        DB::table('navigations')->insert([
            'name' => $navigation[0],
            'href' => $navigation[1],
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
