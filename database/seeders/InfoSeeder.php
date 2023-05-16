<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Add row for the page
         $info = array(
            array('info_name' => 'tag_line', 'info_value' => 'افضل موقع للمحامين ف الوطن العربي'),
            array('info_name' => 'footer_description', 'info_value' => 'افضل موقع للمحامين ف الوطن العربي'),
            array('info_name' => 'address', 'info_value' => '33 عباس العقاد مدينة نصر القاهرة مصر'),
            array('info_name' => 'location', 'info_value' => 'https://google.com'),
            array('info_name' => 'phone', 'info_value' => '+2 0155 945 6778'),
            array('info_name' => 'email', 'info_value' => 'info@yamaitre.com'),
            array('info_name' => 'facebook', 'info_value' => '#'),
            array('info_name' => 'youtube', 'info_value' => '#'),
            array('info_name' => 'twitter', 'info_value' => '#'),
            array('info_name' => 'instagram', 'info_value' => '#'),
            array('info_name' => 'linkedin', 'info_value' => '#'),
            array('info_name' => 'cash_in', 'info_value' => '20'),
            array('info_name' => 'refund', 'info_value' => '40'),
            array('info_name' => 'cash_out', 'info_value' => '20'),
            array('info_name' => 'tax_cost', 'info_value' => '150'),
            array('info_name' => 'consultation_cost', 'info_value' => '250'),
        );

        DB::table('infos')->insert($info);
    }
}
