<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('broading_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('status');
            $table->unsignedBigInteger('broading_house_id')->nullable();
            $table->foreign('broading_house_id')
                ->references('id')->on('broading_houses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
