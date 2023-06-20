<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $item=new \App\Models\Country();
        $item->name_ar='الكويت';
        $item->name_en='Kuwait';
        $item->prefix=965;
        $item->mobile_digits=8;
        $item->currency_ar='دينار كويتي';
        $item->currency_en='D.K';
        $item->is_default=1;
        $item->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
