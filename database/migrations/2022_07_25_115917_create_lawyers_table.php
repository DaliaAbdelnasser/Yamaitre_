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
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id();
            $table->string('governorates');
            $table->string('court_name');
            $table->string('id_photo')->nullable();
            $table->text('description')->nullable();
            $table->string('profile_image')->nullable();
            $table->float('rate')->default(0);
            $table->integer('tasks_count')->default(0);
            // $table->integer('withdrawal_amount')->default(0);
            $table->boolean('status')->default(0)->comment('0 => inactive, 1 => active');
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
        Schema::dropIfExists('lawyers');
    }
};
