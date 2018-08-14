<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
             $table->increments('id');
             $table->string('firstname');
             $table->string('lastname');
             $table->integer('age');
             $table->string('about', 500);
             $table->string('country')->nullable();
             $table->integer('user_id');
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
        Schema::dropIfExists('user_profile');
    }
}
