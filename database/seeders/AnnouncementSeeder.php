<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert(
            [
                'id'               => 1,
                'place'            => 'articles',
                'url'              => 'https://google.com'
            ]);
        DB::table('announcement_user')->insert(
            [
                'announcement_id'  => 1,
                'user_id'          => 2,
            ]);

        //////////////////////////////
        DB::table('announcements')->insert(
            [
                'id'               => 2,
                'place'            => 'tasks',
                'url'              => 'https://google.com'
            ]);
        DB::table('announcement_user')->insert(
            [
                'announcement_id'  => 2,
                'user_id'          => 2,
            ]);
        ///////////////////////////////
        DB::table('announcements')->insert(
            [
                'id'               => 3,
                'place'            => 'lawyers',
                'url'              => 'https://google.com'
            ]);
        DB::table('announcement_user')->insert(
            [
                'announcement_id'  => 3,
                'user_id'          => 1,
            ]);
    }
}
