<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = array(
            array('sender_id' => '2', 'reciever_id' => '3', 'type' => '2', 'chat_channel' => 'chat-1','created_at' => '2022-12-14 19:01:35', 'updated_at' => '2022-12-14 19:01:39'),
            array('sender_id' => '2', 'reciever_id' => '4', 'type' => '2', 'chat_channel' => 'chat-2','created_at' => '2022-12-11 19:01:35', 'updated_at' => '2022-12-14 19:01:39'),
            // array('sender_id' => '3', 'reciever_id' => '2', 'type' => '2', 'created_at' => '2022-12-10 19:01:35', 'updated_at' => '2022-12-14 19:01:39'),
           
        );

        $messages = array(
            array('chat_id' => '1', 'message' => 'hi, how are you ?', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '1', 'message' => 'hi, i am fine and u ?', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '3'),
            array('chat_id' => '1', 'message' => 'i am fine', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '1', 'message' => 'can i help you ?', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '3'),
            array('chat_id' => '1', 'message' => 'yup, i need your help', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '1', 'message' => 'what happened ?', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '3'),
            array('chat_id' => '1', 'message' => 'can i call u soon ?', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '1', 'message' => 'yes any time', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '3'),
            array('chat_id' => '1', 'message' => 'ok', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '1', 'message' => 'ok', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '3'),

            array('chat_id' => '2', 'message' => 'hi ahmed', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '2', 'message' => 'hi', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '4'),
            array('chat_id' => '2', 'message' => 'where are u bro !', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '4'),
            array('chat_id' => '2', 'message' => 'sorry, i am busy these days', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '2', 'message' => 'i will see you soon', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '2', 'message' => 'ok i wait you', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '4'),
            array('chat_id' => '2', 'message' => 'ok bro', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '2', 'message' => 'what do you do now ?', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '4'),
            array('chat_id' => '2', 'message' => 'i am at work', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '2'),
            array('chat_id' => '2', 'message' => 'ok', 'senderable_type' => 'App\Models\Lawyer', 'senderable_id' => '4'),
        );

        DB::table('chats')->insert($rooms);
        DB::table('chat_contents')->insert($messages);

    }
}
