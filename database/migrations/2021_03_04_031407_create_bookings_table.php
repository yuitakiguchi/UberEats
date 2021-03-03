<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('deliver_id');
            $table->unsignedBigInteger('quantity');
            $table->time('trading_time');
            $table->date('trading_date');
            $table->integer('total_amount');
            $table->text('payment_method');
            $table->time('delivery_time');
            $table->integer('Shipping_fee');
            $table->integer('chip');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->foreign('deliver_id')->references('id')->on('delivers')->onDelete('cascade');
            $table->unique(['user_id', 'food_id', 'deliver_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
