<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('product_id');
            $table->dropColumn('item_price');
            $table->dropColumn('price');
        });
        Schema::table('order_products', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->on('stores')->references('id');

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->on('orders')->references('id');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id');

            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->on('sizes')->references('id');

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->on('colors')->references('id');

            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->on('coupons')->references('id');

            $table->double('price',10,2)->nullable();
            $table->integer('discount_ratio')->nullable();
            $table->double('discount',10,2)->nullable();
            $table->double('total',10,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            //
        });
    }
}
