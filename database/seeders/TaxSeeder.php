<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxes = array(
            array('id' => '1','status' => 'inprogress' , 'tax_name' => 'ahmed', 'tax_password' => '1234', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            array('id' => '2','status' => 'inprogress', 'tax_name' => 'sayed', 'tax_password' => '12345', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            array('id' => '3','status' => 'completed', 'tax_name' => 'soaad', 'tax_password' => 'password', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            array('id' => '4','status' => 'completed', 'tax_name' => 'mayar', 'tax_password' => 'password', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            array('id' => '5','status' => 'inprogress' , 'tax_name' => 'ahmed', 'tax_password' => '1234', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            array('id' => '6','status' => 'inprogress', 'tax_name' => 'sayed', 'tax_password' => '12345', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            array('id' => '7','status' => 'completed', 'tax_name' => 'soaad', 'tax_password' => 'password', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            array('id' => '8','status' => 'completed', 'tax_name' => 'mayar', 'tax_password' => 'password', 'notes' => 'no comments', 'tax_file' => '1664878351_umlDiagram.pdf'),
            
        );

        $taxuser = array(
            array('id' => '1','tax_id' => '1' , 'lawyer_id' => '2'),
            array('id' => '2','tax_id' => '2' , 'lawyer_id' => '3'),
            array('id' => '3','tax_id' => '3' , 'lawyer_id' => '2'),
            array('id' => '4','tax_id' => '4' , 'lawyer_id' => '3'),
            array('id' => '5','tax_id' => '5' , 'lawyer_id' => '2'),
            array('id' => '6','tax_id' => '6' , 'lawyer_id' => '3'),
            array('id' => '7','tax_id' => '7' , 'lawyer_id' => '2'),
            array('id' => '8','tax_id' => '8' , 'lawyer_id' => '3'),
                      
        );

        DB::table('taxes')->insert($taxes);
        DB::table('lawyer_tax')->insert($taxuser);
    }
}
