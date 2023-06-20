<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultPayemntTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\PaymentType::insert([
            ['name_ar' => 'كاش','name_en' => 'Cash'],
            ['name_ar' => 'فيزا','name_en' => 'Visa'],
            ['name_ar' => 'مدى','name_en' => 'Mada'],
            ['name_ar' => 'تحويل بنكي','name_en' => 'Transfer'],
            ['name_ar' => 'محفظة','name_en' => 'Wallet'],

        ]);
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
