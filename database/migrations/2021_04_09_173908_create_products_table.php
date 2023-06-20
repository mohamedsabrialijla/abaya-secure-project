<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->text('details_ar')->nullable();
            $table->text('details_en')->nullable();
            $table->text('howtouse_ar')->nullable();
            $table->text('howtouse_en')->nullable();
            $table->integer('category_id')->nullable();
            $table->float('price', 10, 0)->nullable();
            $table->float('discount_ratio', 10, 0)->nullable();
            $table->integer('status')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('is_offer')->nullable()->default(0);
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
        Schema::dropIfExists('products');
    }
}
