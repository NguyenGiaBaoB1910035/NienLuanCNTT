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
        Schema::create('bills', function (Blueprint $table) {

            $table->dateTime('date_time_start');
            $table->dateTime('date_time_end');
            $table->double('tuition_paid');
            $table->string('finished');
            $table->string('note')->nullable();

            $table->unsignedBigInteger('boarding_house_id')->nullable();
            $table->foreign('boarding_house_id')
                ->references('id')->on('boarding_houses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('boarding_room_id')->nullable();
            $table->foreign('boarding_room_id')
                ->references('id')->on('boarding_rooms')
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
