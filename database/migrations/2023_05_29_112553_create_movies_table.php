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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('movie_name');
            $table->string('movie_duration');
            $table->bigInteger('movie_genre')->nullable()->unsigned();
            $table->boolean('movie_status')->default(0);
            $table->date('release_date')->nullable();
            $table->string('movie_img')->nullable();
            $table->timestamps();
            
            $table->foreign('movie_genre')->references('id')->on('movie_genres')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};
