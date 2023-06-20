<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('countries');
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->char('code', 2);
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('phone', 20)->nullable();
            $table->integer('mobile_digits')->nullable();
            $table->string('currency_ar')->nullable();
            $table->string('currency_en', 150)->nullable();
            $table->string('flag', 255)->nullable();
            $table->char('iso3', 3)->nullable();
            $table->integer('iso_numeric')->unsigned()->nullable();
            $table->char('fips', 2)->nullable();
            $table->char('continent_code', 4)->nullable();
            $table->char('tld', 4)->nullable();
            $table->string('currency_code', 3)->nullable();
            $table->string('languages', 50)->nullable();
            $table->string('time_zone', 50)->nullable();
            $table->boolean('is_default')->nullable()->default('1');
            $table->unique(["code"]);
            $table->index(["is_default"]);


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
        Schema::dropIfExists('countries');
    }
}
