<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;

class LawyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lawyers = array(
            array('id' => '2', 'status' => 1, 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Alex', 'court_name'    => 'Aagami', 'rate' => 4),
            array('id' => '3','status' => 1, 'profile_image' => 'lawyer2.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'Helwan', 'rate' => 3.5),
            array('id' => '4','status' => 1, 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'Helwan', 'rate' => 2),
            array('id' => '5','status' => 1, 'profile_image' => 'lawyer2.jpg', 'governorates'  => 'giza', 'court_name'    => 'giza', 'rate' => 3),
            array('id' => '6','status' => 1, 'profile_image' => 'lawyer2.jpg', 'governorates'  => 'giza', 'court_name'    => 'giza', 'rate' => 4),
            array('id' => '7','status' => 1, 'profile_image' => 'lawyer2.jpg', 'governorates'  => 'Alex', 'court_name'    => 'alex', 'rate' => 3),
            array('id' => '8','status' => 1, 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'maadi', 'rate' => 1),
            array('id' => '9','status' => 1, 'profile_image' => 'lawyer2.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'maadi', 'rate' => 0.5),
            array('id' => '10','status' => 1, 'profile_image' => 'lawyer2.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'maadi', 'rate' => 2),
            array('id' => '11','status' => 1, 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'helwan', 'rate' => 4),
            array('id' => '12','status' => 1, 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'helwan', 'rate' => 4.5),
            array('id' => '13','status' => 0, 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'helwan', 'rate' => 2.5),
            array('id' => '14','status' => 1, 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Cairo', 'court_name'    => 'helwan', 'rate' => 2.5),
        );

        $users = array(
            array('first_name' => 'Lawyer', 'last_name' => 'Lawyer', 'email' => 'lawyer@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172354851', 'userable_id' => '2','accept_terms' => 2),
            array('first_name' => 'Lawyer2', 'last_name' => 'Lawyer22', 'email' => 'lawyer2@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172354051', 'userable_id' => '3','accept_terms' => 2),
            array('first_name' => 'Ahmed', 'last_name' => 'Lawyer3', 'email' => 'ahmed@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172354091', 'userable_id' => '4', 'accept_terms' => 2),
            array('first_name' => 'Doaa', 'last_name' => 'Lawyer4', 'email' => 'doaa@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172354791', 'userable_id' => '5', 'accept_terms' => 2),
            array('first_name' => 'Sara', 'last_name' => 'Lawyer5', 'email' => 'sara@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172354391', 'userable_id' => '6', 'accept_terms' => 2),
            array('first_name' => 'Somaya', 'last_name' => 'Lawyer6', 'email' => 'somaya@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01174384091', 'userable_id' => '7', 'accept_terms' => 2),
            array('first_name' => 'Omar', 'last_name' => 'Lawyer7', 'email' => 'omar@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172354591', 'userable_id' => '8', 'accept_terms' => 2),
            array('first_name' => 'Dalia', 'last_name' => 'Lawyer8', 'email' => 'dalia@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172374091', 'userable_id' => '9', 'accept_terms' => 2),
            array('first_name' => 'Gehad', 'last_name' => 'Lawyer9', 'email' => 'gehad@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01172355091', 'userable_id' => '10', 'accept_terms' => 2),
            array('first_name' => 'Mohammed', 'last_name' => 'Lawyer11', 'email' => 'mohammed@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01272354091', 'userable_id' => '11', 'accept_terms' => 2),
            array('first_name' => 'Ahmed', 'last_name' => 'Lawyer12', 'email' => 'ahmedmohamedaneng@gmail.com', 'password' => Hash::make('@Pw123456'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01272354291', 'userable_id' => '12', 'accept_terms' => 1),
            array('first_name' => 'alaa', 'last_name' => 'Lawyer13', 'email' => 'alaa@gmail.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01272924291', 'userable_id' => '13', 'accept_terms' => 1),
            array('first_name' => 'alaa', 'last_name' => 'Lawyer13', 'email' => 'nasserdalia213@gmail.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Lawyer', 'phone' => '01272954291', 'userable_id' => '14', 'accept_terms' => 2),
        );

        DB::table('lawyers')->insert($lawyers);
        DB::table('users')->insert($users);
        

    }
}
