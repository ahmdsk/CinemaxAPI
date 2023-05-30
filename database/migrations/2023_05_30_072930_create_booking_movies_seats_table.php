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
        Schema::create('booking_movies_seats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_movie_id')->unsigned();
            $table->foreign('booking_movie_id')->references('id')->on('booking_movies')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('seat_id')->unsigned();
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('booking_movies_seats');
    }
};
