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
             $table->integer('age')->nullable();
             $table->string('about')->nullable();
             $table->string('country')->nullable();
             $table->string('email')->nullable();
             $table->string('address')->nullable();
             $table->string('city')->nullable();
             $table->string('phone')->nullable();
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
