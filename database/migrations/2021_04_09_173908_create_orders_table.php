<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->float('total_price', 10, 0)->nullable();
            $table->float('products_price', 10, 0)->nullable();
            $table->float('delivery_price', 10, 0)->nullable()->default(0);
            $table->float('tax_price', 10, 0)->nullable();
            $table->integer('tax_ratio')->nullable();
            $table->integer('case_id')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->integer('address_id')->nullable()->default(0);
            $table->integer('payment_type')->nullable();
            $table->integer('transaction_id')->nullable()->default(0);
            $table->integer('is_paid')->nullable()->default(0);

            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
