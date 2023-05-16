<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = array(
            array('id' => '9', 'title' => 'المهمة 9', 'price' => 300,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'حلوان', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 1, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            array('id' => '10', 'title' => 'المهمة 10', 'price' => 400,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'القاهرة', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-10-08T16:59:19.000000Z'),
            array('id' => '11', 'title' => 'المهمة 11', 'price' => 283,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'الجيزة', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-05-08T16:59:19.000000Z'),
            array('id' => '12', 'title' => 'المهمة 12', 'price' => 937,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-02-08T16:59:19.000000Z'),
            array('id' => '13', 'title' => 'المهمة 13', 'price' => 638,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'القاهرة', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-03-08T16:59:19.000000Z'),
            array('id' => '14', 'title' => 'المهمة 14', 'price' => 293,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'الجيزة', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2021-02-08T16:59:19.000000Z'),
            array('id' => '15', 'title' => 'المهمة 15', 'price' => 493,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2020-01-08T16:59:19.000000Z'),
            array('id' => '16', 'title' => 'المهمة 16', 'price' => 233,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'حلوان', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 1, 'created_at' => '2022-12-08T16:59:19.000000Z'),
            array('id' => '17', 'title' => 'المهمة 17', 'price' => 423,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'حلوان', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-01-08T16:59:19.000000Z'),
            array('id' => '18', 'title' => 'المهمة 18', 'price' => 132,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'القاهرة', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-04-08T16:59:19.000000Z'),
            array('id' => '19', 'title' => 'المهمة 19', 'price' => 847,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'الجيزة', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-05-08T16:59:19.000000Z'),
            array('id' => '20', 'title' => 'المهمة 20', 'price' => 394,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-06-08T16:59:19.000000Z'),

            array('id' => '21', 'title' => 'المهمة الرابعة', 'price' => 483,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'حلوان', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 2, 'created_at' => '2022-08-08T16:59:19.000000Z'),
            array('id' => '22', 'title' => 'المهمة الثالثة', 'price' => 564,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'القاهرة', 'starting_date' => '2022-01-28', 'status' => 'inprogress', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-02-08T16:59:19.000000Z'),
            array('id' => '23', 'title' => 'المهمة الثانية', 'price' => 263,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-05-12', 'status' => 'inreview', 'task_file' => '1664878351_umlDiagram.pdf', 'applicants_count' => 0, 'created_at' => '2022-03-08T16:59:19.000000Z'),
            array('id' => '24', 'title' => 'المهمة الأولى', 'price' => 839,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-05-12', 'status' => 'completed', 'task_file' => '1664878351_umlDiagram.pdf', 'applicants_count' => 0, 'created_at' => '2022-09-08T16:59:19.000000Z'),
            
            array('id' => '8', 'title' => 'المهمة الثامنة', 'price' => 300,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'حلوان', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            array('id' => '7', 'title' => 'المهمة السابعة', 'price' => 200,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'القاهرة', 'starting_date' => '2022-01-28', 'status' => 'inprogress', 'task_file' => null, 'applicants_count' => 1, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            array('id' => '6', 'title' => 'المهمة السادسة', 'price' => 400,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-05-12', 'status' => 'inreview', 'task_file' => '1664878351_umlDiagram.pdf', 'applicants_count' => 1, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            array('id' => '5', 'title' => 'المهمة الخامسة', 'price' => 400,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-05-12', 'status' => 'completed', 'task_file' => '1664878351_umlDiagram.pdf', 'applicants_count' => 1, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            
            array('id' => '4', 'title' => 'المهمة الرابعة', 'price' => 300,'court' =>'محكمة الأسرة ', 'description' => 'مهمة في محكمة الأسرة', 'governorates' => 'حلوان', 'starting_date' => '2022-01-25', 'status' => 'todo', 'task_file' => null, 'applicants_count' => 0, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            array('id' => '3', 'title' => 'المهمة الثالثة', 'price' => 200,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'القاهرة', 'starting_date' => '2022-01-28', 'status' => 'inprogress', 'task_file' => null, 'applicants_count' => 1, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            array('id' => '2', 'title' => 'المهمة الثانية', 'price' => 400,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-05-12', 'status' => 'inreview', 'task_file' => '1664878351_umlDiagram.pdf', 'applicants_count' => 1, 'created_at' => '2022-11-08T16:59:19.000000Z'),
            array('id' => '1', 'title' => 'المهمة الأولى', 'price' => 400,'court' =>'محكمة الجنايات ', 'description' => 'مهمة في محكمة الجنايات', 'governorates' => 'الاسكندرية', 'starting_date' => '2022-05-12', 'status' => 'completed', 'task_file' => '1664878351_umlDiagram.pdf', 'applicants_count' => 1, 'created_at' => '2022-11-08T16:59:19.000000Z'),
        );


        

        $usertasks = array(
            array('task_id' => '1', 'user_id' => '2'),
            array('task_id' => '2', 'user_id' => '2'),

            array('task_id' => '3', 'user_id' => '2'),
            array('task_id' => '4', 'user_id' => '3'),

            array('task_id' => '5', 'user_id' => '3'),
            array('task_id' => '6', 'user_id' => '3'),

            array('task_id' => '7', 'user_id' => '3'),
            array('task_id' => '8', 'user_id' => '2'),

            array('task_id' => '9', 'user_id' => '3'),
            array('task_id' => '10', 'user_id' => '3'),
            array('task_id' => '11', 'user_id' => '3'),
            array('task_id' => '12', 'user_id' => '3'),
            array('task_id' => '13', 'user_id' => '3'),
            array('task_id' => '14', 'user_id' => '3'),
            array('task_id' => '15', 'user_id' => '3'),

            array('task_id' => '16', 'user_id' => '2'),
            array('task_id' => '17', 'user_id' => '2'),
            array('task_id' => '18', 'user_id' => '2'),
            array('task_id' => '19', 'user_id' => '2'),
            array('task_id' => '20', 'user_id' => '2'),
            // todo tasks
            array('task_id' => '21', 'user_id' => '1'),
            array('task_id' => '22', 'user_id' => '1'),

            array('task_id' => '23', 'user_id' => '1'),
            array('task_id' => '24', 'user_id' => '1'),
        );


        $offers = array(
            array('task_id' => '4', 'user_id' => '3'),
            array('task_id' => '8', 'user_id' => '2'),
        );

        $reciveres = array(
            array('task_id' => '4', 'user_id' => '2'),
            array('task_id' => '8', 'user_id' => '3'),
        );

        $appliedtasks = array(
            array('task_id' => '3', 'user_id' => '3', 'cost' => 300),
            array('task_id' => '7', 'user_id' => '2', 'cost' => 200),

            array('task_id' => '2', 'user_id' => '3', 'cost' => 400),
            array('task_id' => '2', 'user_id' => '5', 'cost' => 400),
            array('task_id' => '6', 'user_id' => '2', 'cost' => 600),
            
            array('task_id' => '1', 'user_id' => '3', 'cost' => 300),
            array('task_id' => '5', 'user_id' => '2', 'cost' => 600),

            array('task_id' => '9', 'user_id' => '2', 'cost' => 300),
            array('task_id' => '9', 'user_id' => '4', 'cost' => 300),
            array('task_id' => '19', 'user_id' => '3', 'cost' => 600),
            array('task_id' => '16', 'user_id' => '3', 'cost' => 600),

            array('task_id' => '21', 'user_id' => '3', 'cost' => 600),
            array('task_id' => '21', 'user_id' => '2', 'cost' => 400),

            array('task_id' => '22', 'user_id' => '3', 'cost' => 700),
            array('task_id' => '23', 'user_id' => '2', 'cost' => 350),
            array('task_id' => '24', 'user_id' => '3', 'cost' => 530),


            
        );

        $tasksstatus = array(
            // inprogress tasks
            array('task_id' => '3', 'user_id' => '3', 'assigner_id' => '2', 'cost' => 300 ),
            array('task_id' => '7', 'user_id' => '2', 'assigner_id' => '3', 'cost' => 200),
            array('task_id' => '22', 'user_id' => '3', 'assigner_id' => '1', 'cost' => 700), //client


            // inreview tasks
            array('task_id' => '2', 'user_id' => '3', 'assigner_id' => '2', 'cost' => 400),
            array('task_id' => '6', 'user_id' => '2', 'assigner_id' => '3', 'cost' => 600),
            array('task_id' => '23', 'user_id' => '2', 'assigner_id' => '1', 'cost' => 350), //client
            
            // completed tasks
            array('task_id' => '1', 'user_id' => '3', 'assigner_id' => '2', 'cost' => 300),
            array('task_id' => '5', 'user_id' => '2', 'assigner_id' => '3', 'cost' => 600),
            array('task_id' => '24', 'user_id' => '3', 'assigner_id' => '1', 'cost' => 530), //client
        );

        $lawyersreviews = array(
            array('id' => '5', 'lawyer_id' => '2', 'rating' => '5'),
            array('id' => '6', 'lawyer_id' => '3', 'rating' => '10'),
            array('id' => '7', 'lawyer_id' => '2', 'rating' => '2'),
            array('id' => '8', 'lawyer_id' => '3', 'rating' => '3'),
            array('id' => '9', 'lawyer_id' => '2', 'rating' => '5'),
            array('id' => '10', 'lawyer_id' => '3', 'rating' => '7'),
            array('id' => '11', 'lawyer_id' => '2', 'rating' => '2'),
            array('id' => '12', 'lawyer_id' => '3', 'rating' => '3'),
        );

        DB::table('tasks')->insert($tasks);
        DB::table('task_user')->insert($usertasks);
        DB::table('recommended_task')->insert($offers);
        DB::table('invited_task')->insert($reciveres);
        DB::table('applied_task')->insert($appliedtasks);
        DB::table('assigned_task')->insert($tasksstatus);
        DB::table('reviews')->insert($lawyersreviews);
        
    }
}
