<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingSeatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_seat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->integer('seat_number')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('room_id')->nullable();
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
        Schema::dropIfExists('booking_seat');
    }
}
