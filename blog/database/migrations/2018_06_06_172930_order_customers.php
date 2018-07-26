<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table){
            $table->increments('OrderId');
            $table->integer('OrderQuantity');
            $table->date('OrderDate');
            $table->float('OrderTotal');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->integer('phone');
            $table->text('cart');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
