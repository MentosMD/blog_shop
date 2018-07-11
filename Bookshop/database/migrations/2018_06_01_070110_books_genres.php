<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BooksGenres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table){
            $table->increments('id');
            $table->string('title', 255);
            $table->string('description', 500);
            $table->string('author', 100);
            $table->integer('pages');
            $table->float('price');
            $table->string('image');
        });

        Schema::create('genres', function (Blueprint $table){
            $table->increments('GenreId');
            $table->string('GenreName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
        Schema::drop('genres');
    }
}
