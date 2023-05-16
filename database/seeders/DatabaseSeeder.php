<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // call needed seeders
        $this->call([
            PermissionTableSeeder::class,
            AdminsSeeder::class,
            PageSeeder::class,
            InfoSeeder::class, 
            // ClientSeeder::class,
            // LawyerSeeder::class,
            // ArticleSeeder::class,
            // AnnouncementSeeder::class,
            // DistressSeeder::class,
            // TaskSeeder::class,
            // NewsSeeder::class,
            // ReviewSeeder::class,
            // ConsultationSeeder::class,
            // TaxSeeder::class,
            // ChatSeeder::class,
        ]);
    }
}
