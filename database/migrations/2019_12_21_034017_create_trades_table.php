<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Date and time the trade was executed
            $table->dateTime('date');

            // Type of trade (buy to open, buy to close, sell to open, sell to close)
            $table->string('action');

            // Ticker symbol
            $table->string('symbol');

            // Type of instrument trade (stock, option, future, etc)
            $table->string('instrument_type');

            // Total $ value of trade
            $table->float('value');

            // Quantity traded
            $table->integer('quantity');

            // Broker commissions
            $table->float('commissions');

            // Any extraneous fees
            $table->float('fees');

            // Contract expiration date
            $table->date('expiration');

            // Strike price for options
            $table->float('strike_price');

            // Whether the option was a call or put
            $table->string('call_or_put');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}