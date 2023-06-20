<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->nullable();
            $table->string('type')->nullable();
            $table->integer('payment_type')->nullable();
            $table->integer('user_id')->nullable();
            $table->float('amount', 10, 0)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('status')->nullable();
            $table->text('cancel_reson')->nullable();
            $table->string('bank_id')->nullable();
            $table->text('bank_response')->nullable();
            $table->string('bank_code', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
