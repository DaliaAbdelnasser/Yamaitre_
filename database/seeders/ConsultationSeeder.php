<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consultations = array(
            array('id' => '1', 'type' => 'مشكلة شخصية', 'description' => 'أريد المساعدة'),
            array('id' => '2', 'type' => 'مشكلة شخصية',  'description' => 'أريد المساعدة'),
            array('id' => '3', 'type' => 'مشكلة شخصية',  'description' => 'أريد المساعدة'),
           
        );

        $users = array(
            array('id' => '1', 'consultation_id' => '1', 'client_id' => '1'),
            array('id' => '2', 'consultation_id' => '2', 'client_id' => '1'),
            array('id' => '3', 'consultation_id' => '3', 'client_id' => '1'),
        );

        $files = array(
            array('id' => '1', 'consultation_id' => '1', 'file' => '1664793672_umlDiagram.pdf'),
            array('id' => '2', 'consultation_id' => '1', 'file' => '1664793672_umlDiagram.pdf'),
            array('id' => '3', 'consultation_id' => '1', 'file' => '1664793672_umlDiagram.pdf'),
            array('id' => '4', 'consultation_id' => '2', 'file' => '1664793672_umlDiagram.pdf'),
            array('id' => '5', 'consultation_id' => '2', 'file' => '1664793672_umlDiagram.pdf'),
            array('id' => '6', 'consultation_id' => '3', 'file' => '1664793672_umlDiagram.pdf'),
        );

        DB::table('consultations')->insert($consultations);
        DB::table('client_consultation')->insert($users);
        DB::table('files')->insert($files);

    }
}
