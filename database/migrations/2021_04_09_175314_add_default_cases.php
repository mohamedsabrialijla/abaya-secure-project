<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $case=new \App\Models\CaseGeneral();
        $case->name_ar='جديد';
        $case->name_en='new';
        $case->color_hex='#007878';
        $case->color_r=0;
        $case->color_g=120;
        $case->color_b=120;
        $case->save();
        $case=new \App\Models\CaseGeneral();
        $case->name_ar='مؤكد';
        $case->name_en='Accepted';
        $case->color_hex='#32aa32';
        $case->color_r=50;
        $case->color_g=170;
        $case->color_b=50;
        $case->save();
        $case=new \App\Models\CaseGeneral();
        $case->name_ar='جاري التوصيل';
        $case->name_en='On Delivery';
        $case->color_hex='#dd0000';
        $case->color_r=100;
        $case->color_g=0;
        $case->color_b=0;
        $case->save();
        $case=new \App\Models\CaseGeneral();
        $case->name_ar='منتهي';
        $case->name_en='Done';
        $case->color_hex='#3250aa';
        $case->color_r=50;
        $case->color_g=80;
        $case->color_b=170;
        $case->save();
        $case=new \App\Models\CaseGeneral();
        $case->name_ar='ملغي';
        $case->name_en='Canceled';
        $case->color_hex='#9232aa';
        $case->color_r=140;
        $case->color_g=50;
        $case->color_b=170;
        $case->save();
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
