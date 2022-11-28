<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $transporters = ['CityExpress', 'Talaris'];
        foreach($transporters as $transporter)
        DB::table('transporters')->insert([
            'company_name' => $transporter,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
