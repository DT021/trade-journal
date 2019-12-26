<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Date and time the trade was executed
            $table->dateTime('executed_at');

            // Type of trade (buy to open, buy to close, sell to open, sell to close)
            $table->string('action');

            // Ticker symbol
            $table->string('symbol');

            // Type of instrument (stock, option, future, etc)
            $table->string('instrument_type');

            // Total $ value of trade
            $table->float('value');

            // Quantity traded
            $table->integer('quantity');

            //Average Price per contract
            $table->float('avg_price');

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
        Schema::dropIfExists('executions');
    }
}
