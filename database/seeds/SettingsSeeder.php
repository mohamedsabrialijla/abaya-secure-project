<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::updateOrCreate(['name'=>'referral_register_points'],['name'=>'referral_register_points','value'=>30]);
        Settings::updateOrCreate(['name'=>'points_to_cash_one_sar'],['name'=>'points_to_cash_one_sar','value'=>100]);
    }
}
