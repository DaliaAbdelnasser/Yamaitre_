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
        Schema::create('lawyer_tax', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('lawyer_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['tax_id', 'lawyer_id']);
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
        Schema::dropIfExists('lawyer_tax');
    }
};
