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
        Schema::create('chat_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->longText('message')->nullable();
            $table->string('file')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->morphs('senderable');
            $table->tinyInteger('seen')->default(0)->comment('0=>no, 1=>yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_contents');
    }
};
