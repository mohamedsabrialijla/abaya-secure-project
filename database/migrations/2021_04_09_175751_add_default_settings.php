<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Settings::insert([
            ['name' => 'name','value' => '','show_edit' => 1,'tab_id'=>1],
            ['name' => 'email','value' => '','show_edit' => 1,'tab_id'=>1],
            ['name' => 'mobile','value' => '','show_edit' => 1,'tab_id'=>1],
            ['name' => 'address','value' => '','show_edit' => 1,'tab_id'=>1],
            ['name' => 'currency_ar','value' => '','show_edit' => 1,'tab_id'=>1],
            ['name' => 'currency_en','value' => '','show_edit' => 1,'tab_id'=>1],
            ['name' => 'tax','value' => '','show_edit' => 1,'tab_id'=>1],
            ['name' => 'delivery_price','value' => '','show_edit' => 1,'tab_id'=>1],

            ['name' => 'whatsapp','value' => '','show_edit' => 1,'tab_id'=>2],
            ['name' => 'ios','value' => '','show_edit' => 1,'tab_id'=>2],
            ['name' => 'android','value' => '','show_edit' => 1,'tab_id'=>2],
            ['name' => 'facebook','value' => '','show_edit' => 1,'tab_id'=>2],
            ['name' => 'map_geolocation_key','value' => '','show_edit' => 0,'tab_id'=>0],
            ['name' => 'pusher_secret','value' => '','show_edit' => 0,'tab_id'=>0],
            ['name' => 'pusher_app_id','value' => '','show_edit' => 0,'tab_id'=>0],
            ['name' => 'pusher_auth_key','value' => '','show_edit' => 0,'tab_id'=>0],
            ['name' => 'firebase_key','value' => '','show_edit' => 0,'tab_id'=>0],
            ['name' => 'delete_user_notification_period','value' => '','show_edit' => 0,'tab_id'=>0],
            ['name' => 'delete_global_notification_period','value' => '','show_edit' => 0,'tab_id'=>0],
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
