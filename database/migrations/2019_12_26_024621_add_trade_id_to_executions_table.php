<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTradeIdToExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('executions', function (Blueprint $table) {
            $table->unsignedBigInteger('trade_id');
            $table->foreign('trade_id')->references('id')->on('trades');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('executions', function (Blueprint $table) {
            $table->dropColumn('trade_id');
        });
    }
}
