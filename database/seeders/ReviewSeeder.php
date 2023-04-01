<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date('Y-m-d h:m:s');
        $reviews = [[1,1,4,'This product is very good !'],[1,2,3,'This product is good !'],
        [1,3,2,'This product is not very good !'],[1,4,4,'This product is very good !'],[1,5,4,'This product is very good !'],
        [1,6,1,'This product is bad !']];
        foreach($reviews as $review)
        DB::table('reviews')->insert([
            'user_id' => $review[0],
            'product_id' => $review[1],
            'stars' => $review[2],
            'review' => $review[3],
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
