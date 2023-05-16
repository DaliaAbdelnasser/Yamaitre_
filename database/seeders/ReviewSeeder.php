<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Add row for the page
        $Reviews = array(
            array('id' => '1', 'lawyer_id' => '2', 'rating' => '5'),
            array('id' => '2', 'lawyer_id' => '2', 'rating' => '10'),
            array('id' => '3', 'lawyer_id' => '2', 'rating' => '2'),
            array('id' => '4', 'lawyer_id' => '2', 'rating' => '3'),
        );

        DB::table('reviews')->insert($Reviews);

    }
}
