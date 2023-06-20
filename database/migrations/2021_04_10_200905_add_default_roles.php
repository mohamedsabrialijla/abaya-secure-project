<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Rule::insert([
            ['name' => 'view','namear' => 'عرض'],
            ['name' => 'add','namear' => 'اضافة'],
            ['name' => 'edit','namear' => 'تعديل'],
            ['name' => 'delete','namear' => 'حذف'],
            ['name' => 'activate','namear' => 'تفعيل'],

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
