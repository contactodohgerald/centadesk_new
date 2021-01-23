<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlwRefColumnToTransactionModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_models', function (Blueprint $table) {
            //
            $table->string('flw_ref')->nullable();
            $table->string('account_token')->nullable();
            $table->string('consumer_id')->nullable();
            $table->string('consumer_mac')->nullable();
            $table->string('amount_settled')->nullable();
            $table->string('device_fingerprint')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_models', function (Blueprint $table) {
            //
        });
    }
}
