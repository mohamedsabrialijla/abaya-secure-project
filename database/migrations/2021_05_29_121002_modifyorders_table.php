<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('name');
            $table->dropColumn('total_price');
            $table->dropColumn('tax_price');
            $table->dropColumn('delivery_price');
            $table->dropColumn('products_price');
            $table->dropColumn('address_id');
            $table->dropColumn('transaction_id');
            $table->dropColumn('is_paid');
            $table->dropColumn('payment_type');
            $table->dropColumn('cancel_reson');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->on('customers')->references('id');

            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->on('customer_addresses')->references('id');

            $table->double('sub_total_1',10,2)->nullable();
            $table->double('discount',10,2)->nullable();
            $table->double('sub_total_2',10,2)->nullable();
            $table->double('tax',10,2)->nullable();
            $table->double('delivery_cost',10,2)->nullable();
            $table->string('transaction_id')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->enum('payment_type',['credit_cart','cache'])->nullable();
            $table->string('invoice_number')->after('id')->nullable();
            $table->double('total',10,2);
            $table->text('cancel_reason')->nullable();
            $table->string('bill_file_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
