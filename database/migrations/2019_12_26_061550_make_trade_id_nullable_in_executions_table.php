<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTradeIdNullableInExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('executions', function (Blueprint $table) {
            $table->unsignedBigInteger('trade_id')->nullable()->change();
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
            $table->unsignedBigInteger('trade_id')->change();
        });
    }
}
