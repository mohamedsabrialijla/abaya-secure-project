<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('reference_customer__id');
            $table->string('promo_code');
            $table->enum('status',['new_order','new_customer'])->default('new_customer');
            $table->integer('reference_customer_points')->default(0);
            $table->double('reference_customer_wallet')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->on('customers')->references('id');
            $table->foreign('reference_customer__id')->on('customers')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_logs');
    }
}
