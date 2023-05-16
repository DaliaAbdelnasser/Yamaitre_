<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('reciever_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('count_new_message_sender')->default(0);
            $table->unsignedInteger('count_new_message_reciever')->default(0);
            $table->tinyInteger('type')->default(1)->comment('1 => chat, 2 => private');
            $table->unique(['sender_id', 'reciever_id']);
            $table->string('chat_channel');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
