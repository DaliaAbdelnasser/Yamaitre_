<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add row for the client
        $clients = array(
            array('id' => '1', 'profile_image' => 'lawyer.jpg', 'governorates'  => 'Giza'),
        );

        $users = array(
            array('first_name' => 'Client', 'last_name' => 'Client', 'email' => 'client@email.com', 'password' => Hash::make('password'),'userable_type' => 'App\Models\Client', 'phone' => '01172352851', 'userable_id' => '1','accept_terms' => 2),
        );

        DB::table('clients')->insert($clients);
        DB::table('users')->insert($users);
            
    }
}
