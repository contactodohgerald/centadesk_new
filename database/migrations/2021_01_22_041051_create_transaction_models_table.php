<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_models', function (Blueprint $table) {
            $table->id();

            $table->string('unique_id')->unique();
            $table->string('user_unique_id')->nullable();
            $table->string('type_of_user')->nullable();
            $table->decimal('amount',13,4);
            $table->text('description')->nullable();
            $table->string('action_type');//expense, income
            $table->string('status')->default('pending');
            $table->string('reference')->nullable();
            $table->string('country')->nullable();
            $table->string('customer')->nullable();
            $table->string('recurrence')->nullable();

            $table->softDeletes();  //add this line
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
        Schema::dropIfExists('transaction_models');
    }
}
