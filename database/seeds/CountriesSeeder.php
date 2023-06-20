<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $saudiArabiaCountry = Country::insert([
            [
            'code' => 'SA',
            'name_ar' => 'المملكة العربية السعودية',
            'name_en' => 'Saudi Arabia',
            'currency_ar' => 'ريال سعودي',
            'currency_en' => 'SAR',
            'phone' => 966,
            'mobile_digits' => 9,
            'flag' => null,
            'iso3' => 'SAU',
            'iso_numeric' => 682,
            'fips' => 'SA',
            'continent_code' => 'AS',
            'tld' => '.sa',
            'currency_code' => 'SAR',
            'languages' => 'ar-SA',
            'is_default' =>true,
        ],
            [
            'code' => 'KW',
            'name_ar' => 'الكويت',
            'name_en' => 'Kuwait',
            'currency_ar' => 'دينار كويتي',
            'currency_en' => 'KWD',
            'phone' => 965,
            'mobile_digits' => 8,
            'flag' => null,
            'iso3' => 'KWT',
            'iso_numeric' => 414,
            'fips' => 'KU',
            'continent_code' => 'AS',
            'tld' => '.kw',
            'currency_code' => 'KWD',
            'languages' => 'ar-SA',
            'is_default' =>false,
        ],


            [
                'code' => 'AE',
                'name_ar' => 'الإمارات العربية المتحدة',
                'name_en' => 'United Arab Emirates',
                'currency_ar' => 'درهم اماراتي',
                'currency_en' => 'AED',
                'phone' => 971,
                'mobile_digits' => 9,
                'flag' => null,
                'iso3' => 'ARE',
                'iso_numeric' => 414,
                'fips' => 'AE',
                'continent_code' => 'AS',
                'tld' => '.ae',
                'currency_code' => 'AED',
                'languages' => 'ar-SA',
                'is_default' =>false,
            ],
            [
                'code' => 'QA',
                'name_ar' => 'قطر',
                'name_en' => 'Qatar',
                'currency_ar' => 'ريال قطري',
                'currency_en' => 'QAR',
                'phone' => 971,
                'mobile_digits' => 8,
                'flag' => null,
                'iso3' => 'QAT',
                'iso_numeric' => 414,
                'fips' => 'QA',
                'continent_code' => 'AS',
                'tld' => '.qa',
                'currency_code' => 'QAR',
                'languages' => 'ar-SA',
                'is_default' =>false,
            ],           [
                'code' => 'BH',
                'name_ar' => 'البحرين',
                'name_en' => 'Bahrain',
                'currency_ar' => 'دينار بحريني',
                'currency_en' => 'BHD',
                'phone' => 973,
                'mobile_digits' => 8,
                'flag' => null,
                'iso3' => 'BHR',
                'iso_numeric' => 414,
                'fips' => 'BA',
                'continent_code' => 'AS',
                'tld' => '.bh',
                'currency_code' => 'BHD',
                'languages' => 'ar-SA',
                'is_default' =>false,
            ],

        ]);
    }
}
