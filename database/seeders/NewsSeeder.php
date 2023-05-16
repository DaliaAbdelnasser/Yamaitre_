<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = array(
            array('id' => '1', 'news' => 'الخبر الأول الذي يخص المحامي', 'usertype' => 'lawyer'),
            array('id' => '2', 'news' => 'الخبر الأول الذي يخص الموكِّل', 'usertype' => 'client'),
            array('id' => '3', 'news' => 'الخبر الأول الذي يخص الجميع', 'usertype' => 'all'),
            array('id' => '4', 'news' => 'الخبر الثاني الذي يخص المحامي', 'usertype' => 'lawyer'),
            array('id' => '5', 'news' => 'الخبر الأول الذي يخص الموكِّل', 'usertype' => 'client'),
            array('id' => '6', 'news' => 'الخبر الثاني الذي يخص الجميع', 'usertype' => 'all'),        
        );

        DB::table('news')->insert($news);


    }
}
