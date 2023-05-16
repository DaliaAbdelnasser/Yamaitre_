<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $distress = array(
            array('id' => '1', 'type' => 'مشكلة شخصية', 'governorate' => 'القاهرة', 'description' => 'أريد المساعدة'),
            array('id' => '2', 'type' => 'مشكلة عامة', 'governorate' => 'حلوان', 'description' => 'أحتاج إلى من يساعدني في مشكلتي',),
        );

        $distressuser = array(
            array('distress_id' => '1', 'user_id' => '2'),
            array('distress_id' => '2', 'user_id' => '3'),
        );

        DB::table('distresses')->insert($distress);
        DB::table('distress_user')->insert($distressuser);

       
    }
}
