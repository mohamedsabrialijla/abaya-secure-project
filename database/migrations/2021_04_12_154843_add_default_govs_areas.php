<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultGovsAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->loadKW();
        //$this->loadSud();
    }

    private function loadKW(){
        $areas = array(
            array('id' => '1','name_ar' => 'شرق','name_en' => 'Sharq','gov_id' => '1','deleted_at' => NULL),
            array('id' => '2','name_ar' => 'الدعية','name_en' => 'Daiya','gov_id' => '1','deleted_at' => NULL),
            array('id' => '3','name_ar' => 'ضاحية عبد الله السالم','name_en' => 'Abdullah as-Salim suburb','gov_id' => '1','deleted_at' => NULL),
            array('id' => '4','name_ar' => 'النزهة','name_en' => 'Nuzha','gov_id' => '1','deleted_at' => NULL),
            array('id' => '5','name_ar' => 'النعيم','name_en' => 'Naeem','gov_id' => '2','deleted_at' => NULL),
            array('id' => '6','name_ar' => 'القصر','name_en' => 'Qaser','gov_id' => '2','deleted_at' => NULL),
            array('id' => '7','name_ar' => 'الواحة','name_en' => 'Waha','gov_id' => '2','deleted_at' => NULL),
            array('id' => '8','name_ar' => 'النسيم','name_en' => 'Naseem','gov_id' => '2','deleted_at' => NULL),
            array('id' => '9','name_ar' => 'العبدلي','name_en' => 'Abdaly','gov_id' => '2','deleted_at' => NULL),
            array('id' => '10','name_ar' => 'الجهراء','name_en' => 'Al Jahra','gov_id' => '2','deleted_at' => NULL),
            array('id' => '11','name_ar' => 'خيطان','name_en' => 'Khaitan','gov_id' => '3','deleted_at' => NULL),
            array('id' => '12','name_ar' => 'الفروانية','name_en' => 'Farwaniya','gov_id' => '3','deleted_at' => NULL),
            array('id' => '13','name_ar' => 'الرحاب','name_en' => 'Rihab','gov_id' => '3','deleted_at' => NULL),
            array('id' => '15','name_ar' => 'السالمية','name_en' => 'Salmiya','gov_id' => '4','deleted_at' => NULL),
            array('id' => '16','name_ar' => 'حولي','name_en' => 'Hawally','gov_id' => '4','deleted_at' => NULL),
            array('id' => '17','name_ar' => 'الجابرية','name_en' => 'Jabriya','gov_id' => '4','deleted_at' => NULL),
            array('id' => '18','name_ar' => 'الزهراء','name_en' => 'Zahra','gov_id' => '4','deleted_at' => NULL),
            array('id' => '19','name_ar' => 'ضاحية صباح السالم','name_en' => 'Sabah as-Salim suburb','gov_id' => '5','deleted_at' => NULL),
            array('id' => '20','name_ar' => 'القصور','name_en' => 'Qusur','gov_id' => '5','deleted_at' => NULL),
            array('id' => '21','name_ar' => 'القرين','name_en' => 'Qurain','gov_id' => '5','deleted_at' => NULL),
            array('id' => '22','name_ar' => 'الفنيطيس','name_en' => 'Funaitis','gov_id' => '5','deleted_at' => NULL),
            array('id' => '24','name_ar' => 'مبارك الكبير','name_en' => 'Mubarak al-Kabeer','gov_id' => '5','deleted_at' => NULL),
            array('id' => '25','name_ar' => 'الرقة','name_en' => 'Rigga','gov_id' => '6','deleted_at' => NULL),
            array('id' => '26','name_ar' => 'المنقف','name_en' => 'Mangaf','gov_id' => '6','deleted_at' => NULL),
            array('id' => '27','name_ar' => 'الفنطاس','name_en' => 'Fintas','gov_id' => '6','deleted_at' => NULL),
            array('id' => '28','name_ar' => 'الصباحية','name_en' => 'Sabahiya','gov_id' => '6','deleted_at' => NULL),
            array('id' => '29','name_ar' => 'الأحمدي','name_en' => 'Ahmadi','gov_id' => '6','deleted_at' => NULL),
            array('id' => '30','name_ar' => 'المهبولة','name_en' => 'Mahbula','gov_id' => '6','deleted_at' => NULL),
            array('id' => '31','name_ar' => 'السرة','name_en' => 'Surra','gov_id' => '1','deleted_at' => NULL),
            array('id' => '32','name_ar' => 'الأندلس','name_en' => 'Andalous','gov_id' => '3','deleted_at' => NULL),
            array('id' => '33','name_ar' => 'دسمان','name_en' => 'Dasman','gov_id' => '1','deleted_at' => NULL),
            array('id' => '34','name_ar' => 'تيماء','name_en' => 'Taima','gov_id' => '2','deleted_at' => NULL),
            array('id' => '35','name_ar' => 'العارضيه','name_en' => 'Ardiya','gov_id' => '3','deleted_at' => NULL),
            array('id' => '37','name_ar' => 'الرقعى','name_en' => 'Riggae','gov_id' => '3','deleted_at' => NULL),
            array('id' => '39','name_ar' => 'الفردوس','name_en' => 'Firdous','gov_id' => '3','deleted_at' => NULL),
            array('id' => '41','name_ar' => 'أشبيليه','name_en' => 'Eshbilya','gov_id' => '3','deleted_at' => NULL),
            array('id' => '42','name_ar' => 'جليب الشويخ','name_en' => 'Jleeb AL-Shuyoukh','gov_id' => '3','deleted_at' => NULL),
            array('id' => '43','name_ar' => 'العمرية','name_en' => 'Omariya','gov_id' => '3','deleted_at' => NULL),
            array('id' => '44','name_ar' => 'صباح الناصر','name_en' => 'Sabah Al - Nasser','gov_id' => '3','deleted_at' => NULL),
            array('id' => '45','name_ar' => 'عبدالله المبارك','name_en' => 'Abdullah Al Mubarak','gov_id' => '3','deleted_at' => NULL),
            array('id' => '46','name_ar' => 'الضجيج','name_en' => 'Dajeej','gov_id' => '3','deleted_at' => NULL),
            array('id' => '47','name_ar' => 'الظهر','name_en' => 'Zuhar','gov_id' => '6','deleted_at' => NULL),
            array('id' => '48','name_ar' => 'هدية','name_en' => 'Hadiya','gov_id' => '6','deleted_at' => NULL),
            array('id' => '49','name_ar' => 'أبو حليفة','name_en' => 'Abu Hulaifa','gov_id' => '6','deleted_at' => NULL),
            array('id' => '50','name_ar' => 'الفحيحيل','name_en' => 'Fahaheel','gov_id' => '6','deleted_at' => NULL),
            array('id' => '51','name_ar' => 'ضاحية جابر العلى','name_en' => 'Jabir al-Ali Suburb','gov_id' => '6','deleted_at' => NULL),
            array('id' => '52','name_ar' => 'ضاحية فهد الأحمد','name_en' => 'Fahd al-Ahmad Suburb','gov_id' => '6','deleted_at' => NULL),
            array('id' => '53','name_ar' => 'المرقاب','name_en' => 'Mirgab','gov_id' => '1','deleted_at' => NULL),
            array('id' => '55','name_ar' => 'كيفان','name_en' => 'Kaifan','gov_id' => '1','deleted_at' => NULL),
            array('id' => '56','name_ar' => 'الدوحة','name_en' => 'Doha','gov_id' => '1','deleted_at' => NULL),
            array('id' => '57','name_ar' => 'الدسمة','name_en' => 'Dasma','gov_id' => '1','deleted_at' => NULL),
            array('id' => '58','name_ar' => 'بنيد القار','name_en' => 'Benid Al-Qar','gov_id' => '1','deleted_at' => NULL),
            array('id' => '60','name_ar' => 'الفيحاء','name_en' => 'Faiha','gov_id' => '1','deleted_at' => NULL),
            array('id' => '61','name_ar' => 'العديلية','name_en' => 'Adiliya','gov_id' => '1','deleted_at' => NULL),
            array('id' => '62','name_ar' => 'الخالدية','name_en' => 'Khaldiya','gov_id' => '1','deleted_at' => NULL),
            array('id' => '63','name_ar' => 'القادسية','name_en' => 'Qadsiya','gov_id' => '1','deleted_at' => NULL),
            array('id' => '64','name_ar' => 'قرطبة','name_en' => 'Qurtuba','gov_id' => '1','deleted_at' => NULL),
            array('id' => '65','name_ar' => 'اليرموك','name_en' => 'Yarmuk','gov_id' => '1','deleted_at' => NULL),
            array('id' => '66','name_ar' => 'الشويخ','name_en' => 'Shuwaikh','gov_id' => '1','deleted_at' => NULL),
            array('id' => '67','name_ar' => 'الرى','name_en' => 'Rai','gov_id' => '1','deleted_at' => NULL),
            array('id' => '68','name_ar' => 'غرناطة','name_en' => 'Ghirnata','gov_id' => '1','deleted_at' => NULL),
            array('id' => '69','name_ar' => 'الصليبيخات','name_en' => 'Sulaibikhat','gov_id' => '1','deleted_at' => NULL),
            array('id' => '70','name_ar' => 'النهضة','name_en' => 'Nahdha','gov_id' => '1','deleted_at' => NULL),
            array('id' => '71','name_ar' => 'مدينة جابر الأحمد','name_en' => 'Jabir al-Ahmad City','gov_id' => '1','deleted_at' => NULL),
            array('id' => '72','name_ar' => 'القيروان','name_en' => 'Qairawan','gov_id' => '1','deleted_at' => NULL),
            array('id' => '73','name_ar' => 'شمال غرب الصليبيخات','name_en' => 'North West AL Sulaibikhat','gov_id' => '1','deleted_at' => NULL),
            array('id' => '74','name_ar' => 'الشعب','name_en' => 'Shaab','gov_id' => '4','deleted_at' => NULL),
            array('id' => '75','name_ar' => 'الرميثية','name_en' => 'Rumaithiya','gov_id' => '4','deleted_at' => NULL),
            array('id' => '77','name_ar' => 'مشرف','name_en' => 'Mishrif','gov_id' => '4','deleted_at' => NULL),
            array('id' => '78','name_ar' => 'بيان','name_en' => 'Bayan','gov_id' => '4','deleted_at' => NULL),
            array('id' => '79','name_ar' => 'البدع','name_en' => 'Bidea','gov_id' => '4','deleted_at' => NULL),
            array('id' => '80','name_ar' => 'سلوى','name_en' => 'Salwa','gov_id' => '4','deleted_at' => NULL),
            array('id' => '82','name_ar' => 'الصديق','name_en' => 'Siddeeq','gov_id' => '4','deleted_at' => NULL),
            array('id' => '83','name_ar' => 'حطين','name_en' => 'Hittin','gov_id' => '4','deleted_at' => NULL),
            array('id' => '84','name_ar' => 'السلام','name_en' => 'Salam','gov_id' => '4','deleted_at' => NULL),
            array('id' => '85','name_ar' => 'الشهداء','name_en' => 'Shuhada','gov_id' => '4','deleted_at' => NULL),
            array('id' => '86','name_ar' => 'العدان','name_en' => 'Adan','gov_id' => '5','deleted_at' => NULL),
            array('id' => '87','name_ar' => 'المسيلة','name_en' => 'Misīla','gov_id' => '5','deleted_at' => NULL),
            array('id' => '88','name_ar' => 'صبحان','name_en' => 'Sabhan','gov_id' => '5','deleted_at' => NULL),
            array('id' => '89','name_ar' => 'أبوفطيرة','name_en' => 'Abu Fteira','gov_id' => '5','deleted_at' => NULL),
            array('id' => '90','name_ar' => 'الصليبية','name_en' => 'Sulaibiya','gov_id' => '2','deleted_at' => NULL),
            array('id' => '92','name_ar' => 'العيون','name_en' => 'Ayoun','gov_id' => '2','deleted_at' => NULL),
            array('id' => '93','name_ar' => 'سعدالعبدالله','name_en' => 'Saad Al-Abdullah','gov_id' => '2','deleted_at' => NULL),
            array('id' => '94','name_ar' => 'المسايل','name_en' => 'AL Masayel','gov_id' => '5','deleted_at' => NULL),
            array('id' => '95','name_ar' => 'مدينة الكويت','name_en' => 'Kuwait City','gov_id' => '1','deleted_at' => NULL),
            array('id' => '96','name_ar' => 'الصوابر','name_en' => 'Sawabir','gov_id' => '1','deleted_at' => NULL),
            array('id' => '97','name_ar' => 'الوطية','name_en' => 'watia','gov_id' => '1','deleted_at' => NULL),
            array('id' => '98','name_ar' => 'الروضة','name_en' => 'Rawda','gov_id' => '1','deleted_at' => NULL),
            array('id' => '100','name_ar' => 'المنصورية','name_en' => 'Mansouriya','gov_id' => '1','deleted_at' => NULL),
            array('id' => '101','name_ar' => 'المقوع','name_en' => '\'Miqwa','gov_id' => '6','deleted_at' => NULL),
            array('id' => '102','name_ar' => 'الوفرة','name_en' => 'Wafra','gov_id' => '6','deleted_at' => NULL),
            array('id' => '103','name_ar' => 'الزور','name_en' => 'Zoor','gov_id' => '6','deleted_at' => NULL),
            array('id' => '104','name_ar' => 'الخيران','name_en' => 'Khairan','gov_id' => '6','deleted_at' => NULL),
            array('id' => '105','name_ar' => 'ميناء عبدالله','name_en' => 'Abdullah Port','gov_id' => '6','deleted_at' => NULL),
            array('id' => '106','name_ar' => 'بنيدر','name_en' => 'Bneidar','gov_id' => '6','deleted_at' => NULL),
            array('id' => '107','name_ar' => 'الجليعة','name_en' => 'Jilei\'a','gov_id' => '6','deleted_at' => NULL),
            array('id' => '108','name_ar' => 'الضباعية','name_en' => 'Dibaeia','gov_id' => '6','deleted_at' => NULL),
            array('id' => '109','name_ar' => 'الشعيبة','name_en' => 'Shuaiba','gov_id' => '6','deleted_at' => NULL),
            array('id' => '110','name_ar' => 'واره','name_en' => 'Wara','gov_id' => '6','deleted_at' => NULL),
            array('id' => '111','name_ar' => 'مدينة صباح الاحمد','name_en' => 'Sabah al-Ahmad City','gov_id' => '6','deleted_at' => NULL),
            array('id' => '112','name_ar' => 'النويصيب','name_en' => 'Nuwaiseeb','gov_id' => '6','deleted_at' => NULL),
            array('id' => '113','name_ar' => 'ضاحية على صباح السالم','name_en' => 'Suburb Ali Sabah Al Salem','gov_id' => '6','deleted_at' => NULL),
            array('id' => '114','name_ar' => 'الشدادية','name_en' => 'Shadadiya','gov_id' => '3','deleted_at' => NULL),
            array('id' => '115','name_ar' => 'خيطان الجديدة','name_en' => 'New Khaitan','gov_id' => '3','deleted_at' => NULL),
            array('id' => '116','name_ar' => 'العباسية','name_en' => 'Abbasiyah','gov_id' => '3','deleted_at' => NULL),
            array('id' => '117','name_ar' => 'الحساوى','name_en' => 'Hasawi','gov_id' => '3','deleted_at' => NULL),
            array('id' => '118','name_ar' => 'أبرق خيطان','name_en' => 'Abraq Khaitan','gov_id' => '3','deleted_at' => NULL),
            array('id' => '119','name_ar' => 'أمغرة','name_en' => 'Amghara','gov_id' => '2','deleted_at' => NULL),
            array('id' => '120','name_ar' => 'القيصرية','name_en' => 'AL Qaysaria','gov_id' => '2','deleted_at' => NULL),
            array('id' => '121','name_ar' => 'الجهراء القديمة','name_en' => 'Old Jahra','gov_id' => '2','deleted_at' => NULL),
            array('id' => '122','name_ar' => 'كاظمة','name_en' => 'Kazma','gov_id' => '2','deleted_at' => NULL),
            array('id' => '123','name_ar' => 'السالمي','name_en' => 'Salami','gov_id' => '2','deleted_at' => NULL),
            array('id' => '124','name_ar' => 'المطلاع','name_en' => 'Mutlaa','gov_id' => '2','deleted_at' => NULL),
            array('id' => '125','name_ar' => 'مدينة التحرير','name_en' => 'Tahrir City','gov_id' => '2','deleted_at' => NULL),
            array('id' => '126','name_ar' => 'كبد','name_en' => 'Kabad','gov_id' => '2','deleted_at' => NULL),
            array('id' => '128','name_ar' => 'الصبية','name_en' => 'Sabiyah','gov_id' => '2','deleted_at' => NULL),
            array('id' => '129','name_ar' => 'ميدان حولى','name_en' => 'Maidan Hawalli','gov_id' => '4','deleted_at' => NULL),
            array('id' => '130','name_ar' => 'النقرة','name_en' => 'Nugra','gov_id' => '4','deleted_at' => NULL),
            array('id' => '131','name_ar' => 'ضاحية مبارك العبدالله الجابر','name_en' => 'Mubarak Suburb Al Abdullah Al Jaber','gov_id' => '4','deleted_at' => NULL),
            array('id' => '132','name_ar' => 'ابو الحصانية','name_en' => 'Abu AL-Husaniyah','gov_id' => '5','deleted_at' => NULL),
            array('id' => '133','name_ar' => 'الصالحية','name_en' => 'Salhiya','gov_id' => '1','deleted_at' => NULL),
            array('id' => '134','name_ar' => 'الشامية','name_en' => 'Shamiya','gov_id' => '1','deleted_at' => NULL),
            array('id' => '136','name_ar' => 'الرابية','name_en' => 'Rabia','gov_id' => '3','deleted_at' => NULL),
            array('id' => '137','name_ar' => 'الري','name_en' => 'Ria','gov_id' => '3','deleted_at' => NULL),
            array('id' => '138','name_ar' => 'أم الهيمان','name_en' => 'Umm Al Hayman','gov_id' => '6','deleted_at' => NULL),
            array('id' => '139','name_ar' => 'العقيلة','name_en' => 'Eqaila','gov_id' => '6','deleted_at' => NULL)
        );

        $govs = array(
            array('id' => '1','name_ar' => 'محافظة العاصمة','name_en' => 'Asema Gov','country_id' => '1','deleted_at' => NULL),
            array('id' => '2','name_ar' => 'محافظة الجهراء','name_en' => 'Jahraa Gov','country_id' => '1','deleted_at' => NULL),
            array('id' => '3','name_ar' => 'محافظة الفروانية','name_en' => 'Ferwaniya Gov','country_id' => '1','deleted_at' => NULL),
            array('id' => '4','name_ar' => 'محافظة حولي','name_en' => 'Hwalli Gov','country_id' => '1','deleted_at' => NULL),
            array('id' => '5','name_ar' => 'محافظة مبارك الكبير','name_en' => 'Mobarak Alkabeer Gov','country_id' => '1','deleted_at' => NULL),
            array('id' => '6','name_ar' => 'محافظة الأحمدي','name_en' => 'Ahmadi Gov','country_id' => '1','deleted_at' => NULL)
        );
        \App\Models\Gov::insert($govs);
        \App\Models\Area::insert($areas);
    }
    private function loadSud(){

        $govs = array(
            array('id' => '1', 'name_ar' => 'محافظة الرياض', 'name_en' => 'Riyadh','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '2', 'name_ar' => 'محافظة مكة المكرمة', 'name_en' => 'Makkah','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '3', 'name_ar' => 'محافظة المدينة المنورة', 'name_en' => 'Medina','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '4', 'name_ar' => 'محافظة القصيم', 'name_en' => 'Qaseem','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '5', 'name_ar' => 'محافظة الشرقية', 'name_en' => 'Sharqia','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '6', 'name_ar' => 'محافظة عسير', 'name_en' => 'Aseer','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '8', 'name_ar' => 'محافظة تبوك', 'name_en' => 'Tabook','country_id' => 2,  'deleted_at' => NULL),
            array('id' => '9', 'name_ar' => 'محافظة حائل', 'name_en' => 'Haal', 'country_id' => 2, 'deleted_at' => NULL),
            array('id' => '10', 'name_ar' => 'محافظة الحدود الشمالية', 'name_en' => 'Alhudod','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '11', 'name_ar' => 'محافظة جازان', 'name_en' => 'Jazan','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '12', 'name_ar' => 'محافظة نجران', 'name_en' => 'Najran','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '13', 'name_ar' => 'محافظة الباحة', 'name_en' => 'Albaha','country_id' => 2, 'deleted_at' => NULL),
            array('id' => '15', 'name_ar' => 'محافظة الجوف', 'name_en' => 'Aljouf','country_id' => 2, 'deleted_at' => NULL)
        );


        $areas = array(
            array('id' => '1', 'name_ar' => 'الرياض', 'name_en' => 'Riyadh', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '2', 'name_ar' => 'الدرعية', 'name_en' => 'Dereya', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '3', 'name_ar' => 'الخرج', 'name_en' => 'Alkharaj', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '4', 'name_ar' => 'الدوادمي', 'name_en' => 'Aldoadmy', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '5', 'name_ar' => ' مكة المكرمة', 'name_en' => 'Makka', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '6', 'name_ar' => 'جدة', 'name_en' => 'Jeda', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '7', 'name_ar' => 'الطائف', 'name_en' => 'Altaef', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '8', 'name_ar' => 'القنفذة', 'name_en' => 'Alqunfutha', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '9', 'name_ar' => 'الليث', 'name_en' => 'Al Lith', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '10', 'name_ar' => ' رابغ', 'name_en' => 'Raih', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '11', 'name_ar' => 'المدينة المنورة', 'name_en' => 'Almadena', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '12', 'name_ar' => 'ينبع', 'name_en' => 'Yanbu', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '13', 'name_ar' => 'العلا', 'name_en' => 'Alula', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '14', 'name_ar' => 'مهد الذهب', 'name_en' => 'Mahd', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '15', 'name_ar' => 'بريدة', 'name_en' => 'Bareda', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '16', 'name_ar' => 'عنيزة', 'name_en' => 'Aneza', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '17', 'name_ar' => 'الرس', 'name_en' => 'Al Ras', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '18', 'name_ar' => 'المذنب', 'name_en' => 'Almuthanb', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '19', 'name_ar' => 'البكيرية', 'name_en' => 'Albakeria', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '20', 'name_ar' => 'الدمام', 'name_en' => 'Al Damam', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '21', 'name_ar' => 'الأحساء', 'name_en' => 'Alahsaa', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '22', 'name_ar' => 'حفر الباطن', 'name_en' => 'Hafr Al Batin', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '23', 'name_ar' => 'الجبيل', 'name_en' => 'Al Jabel', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '24', 'name_ar' => 'القطيف', 'name_en' => 'Al Qatef', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '32', 'name_ar' => 'تبوك', 'name_en' => 'Tabok', 'gov_id' => '8', 'deleted_at' => NULL),
            array('id' => '33', 'name_ar' => 'المزاحميه', 'name_en' => 'ALMZAHMEH', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '34', 'name_ar' => 'ابها', 'name_en' => 'ABHA', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '35', 'name_ar' => 'خميس مشيط', 'name_en' => 'Khamis Mushait', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '37', 'name_ar' => 'المجمعة', 'name_en' => 'almujmaea', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '39', 'name_ar' => 'القويعية', 'name_en' => 'alquayeia', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '40', 'name_ar' => 'الأفلاج', 'name_en' => 'Aflaj', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '41', 'name_ar' => 'وادي الدواسر', 'name_en' => 'Wadi aldawasir', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '42', 'name_ar' => 'الزلفي', 'name_en' => 'Zulfi', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '43', 'name_ar' => 'شقراء', 'name_en' => 'shuqara', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '44', 'name_ar' => 'حوطة بني تميم', 'name_en' => 'Hota Bani Tamim', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '45', 'name_ar' => 'عفيف', 'name_en' => 'Afif', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '46', 'name_ar' => 'الغاط', 'name_en' => 'Ghat', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '47', 'name_ar' => 'السليل', 'name_en' => 'Alsalil', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '48', 'name_ar' => 'ضرما', 'name_en' => 'Darma', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '49', 'name_ar' => 'رماح', 'name_en' => 'Ramah', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '50', 'name_ar' => 'ثادق', 'name_en' => 'thadiq', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '51', 'name_ar' => 'حريملاء', 'name_en' => 'Harelim', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '52', 'name_ar' => 'الحريق', 'name_en' => 'Alhariq', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '53', 'name_ar' => 'مرات', 'name_en' => 'Marrat', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '54', 'name_ar' => 'خليص', 'name_en' => 'Khulais', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '55', 'name_ar' => 'الخرمة', 'name_en' => 'alkharma', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '56', 'name_ar' => 'رنية', 'name_en' => 'Rania', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '57', 'name_ar' => 'تربة', 'name_en' => 'turba', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '58', 'name_ar' => 'الجموم', 'name_en' => 'aljumum', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '59', 'name_ar' => 'الكامل', 'name_en' => 'alkamil', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '60', 'name_ar' => 'المويه', 'name_en' => 'almawiyuh', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '61', 'name_ar' => 'ميسان', 'name_en' => 'Maysan', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '62', 'name_ar' => 'أضم', 'name_en' => 'aduma', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '63', 'name_ar' => 'العرضيات', 'name_en' => 'alerdiat', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '64', 'name_ar' => 'بحرة', 'name_en' => 'bahra', 'gov_id' => '2', 'deleted_at' => NULL),
            array('id' => '65', 'name_ar' => 'الحناكية', 'name_en' => 'Hanakia', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '66', 'name_ar' => 'بدر', 'name_en' => 'Badr', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '67', 'name_ar' => 'خيبر', 'name_en' => 'Khaibar', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '68', 'name_ar' => 'العيض', 'name_en' => 'aleid', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '69', 'name_ar' => 'وادي الفرع', 'name_en' => 'wadi alfare', 'gov_id' => '3', 'deleted_at' => NULL),
            array('id' => '70', 'name_ar' => 'البدائع', 'name_en' => 'Albadayea', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '71', 'name_ar' => 'الأسياح', 'name_en' => 'Asiyah', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '72', 'name_ar' => 'النبهانية', 'name_en' => 'Anabhaniyah', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '73', 'name_ar' => 'الشماسية', 'name_en' => 'Al Shamsia', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '74', 'name_ar' => 'عيون الجواء', 'name_en' => 'euyun aljawa', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '75', 'name_ar' => 'رياض الخبراء', 'name_en' => 'Riyadh Alkhubara', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '76', 'name_ar' => 'عقلة الصقور', 'name_en' => 'euqlat alsuqur', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '77', 'name_ar' => 'ضرية', 'name_en' => 'duriya', 'gov_id' => '4', 'deleted_at' => NULL),
            array('id' => '78', 'name_ar' => 'الخبر', 'name_en' => 'alkhabar', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '79', 'name_ar' => 'الخفجي', 'name_en' => 'Khafji', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '80', 'name_ar' => 'رأس التنورة', 'name_en' => 'ras altnwr', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '81', 'name_ar' => 'بقيق', 'name_en' => 'Bqaiq', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '82', 'name_ar' => 'النعيرية', 'name_en' => 'Alneria', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '83', 'name_ar' => 'قرية العليا', 'name_en' => 'qarya aleulya', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '84', 'name_ar' => 'العديد', 'name_en' => 'aledyd', 'gov_id' => '5', 'deleted_at' => NULL),
            array('id' => '85', 'name_ar' => 'بيشة', 'name_en' => 'Bisha', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '86', 'name_ar' => 'النماص', 'name_en' => 'Nemes', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '87', 'name_ar' => 'محايل عسير', 'name_en' => 'Mahayl Asir', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '88', 'name_ar' => 'ظهران الجنوب', 'name_en' => 'Dhahran aljanub', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '89', 'name_ar' => 'تثليث', 'name_en' => 'tathlith', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '90', 'name_ar' => 'سراة عبيدة', 'name_en' => 'Sarat Obeida', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '91', 'name_ar' => 'رجال ألمع', 'name_en' => 'rijal  almae', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '92', 'name_ar' => 'بلقرن', 'name_en' => 'Balqarn', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '93', 'name_ar' => 'أحد رفيدة', 'name_en' => 'Aahad Rafidah', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '94', 'name_ar' => 'المجاردة', 'name_en' => 'Majarda', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '95', 'name_ar' => 'البرك', 'name_en' => 'Albarak', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '96', 'name_ar' => 'تنومة', 'name_en' => 'Tanuma', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '97', 'name_ar' => 'طريب', 'name_en' => 'trib', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '98', 'name_ar' => 'الوجه', 'name_en' => 'alwajh', 'gov_id' => '8', 'deleted_at' => NULL),
            array('id' => '99', 'name_ar' => 'ضبا', 'name_en' => 'Dba', 'gov_id' => '8', 'deleted_at' => NULL),
            array('id' => '100', 'name_ar' => 'تيماء', 'name_en' => 'Taima', 'gov_id' => '8', 'deleted_at' => NULL),
            array('id' => '101', 'name_ar' => 'أملج', 'name_en' => 'amlaj', 'gov_id' => '8', 'deleted_at' => NULL),
            array('id' => '102', 'name_ar' => 'حقل', 'name_en' => 'Haql', 'gov_id' => '8', 'deleted_at' => NULL),
            array('id' => '103', 'name_ar' => 'البدع', 'name_en' => 'albadae', 'gov_id' => '8', 'deleted_at' => NULL),
            array('id' => '105', 'name_ar' => 'حائل', 'name_en' => 'Hail', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '106', 'name_ar' => 'بقعاء', 'name_en' => 'biqaea', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '107', 'name_ar' => 'الغزالة', 'name_en' => 'Ghazala', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '108', 'name_ar' => 'الشنان', 'name_en' => 'alshannan', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '109', 'name_ar' => 'الحائط', 'name_en' => 'alhayit', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '110', 'name_ar' => 'السليمي', 'name_en' => 'Sulaimi', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '111', 'name_ar' => 'الشملي', 'name_en' => 'Shamli', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '112', 'name_ar' => 'موقق', 'name_en' => 'mawqiq', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '113', 'name_ar' => 'سميراء', 'name_en' => 'samira', 'gov_id' => '9', 'deleted_at' => NULL),
            array('id' => '114', 'name_ar' => 'عرعر', 'name_en' => 'Arar', 'gov_id' => '10', 'deleted_at' => NULL),
            array('id' => '115', 'name_ar' => 'رفحاء', 'name_en' => 'Rafha', 'gov_id' => '10', 'deleted_at' => NULL),
            array('id' => '116', 'name_ar' => 'طريف', 'name_en' => 'Tarif', 'gov_id' => '10', 'deleted_at' => NULL),
            array('id' => '117', 'name_ar' => 'العويقيلة', 'name_en' => 'Al Awaileh', 'gov_id' => '10', 'deleted_at' => NULL),
            array('id' => '118', 'name_ar' => 'جازان', 'name_en' => 'Jazan', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '119', 'name_ar' => 'صبيا', 'name_en' => 'sabia', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '120', 'name_ar' => 'أبو عريش', 'name_en' => 'Abu Arish', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '121', 'name_ar' => 'صامطة', 'name_en' => 'samita', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '122', 'name_ar' => 'بيش', 'name_en' => 'Bish', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '123', 'name_ar' => 'الدرب', 'name_en' => 'aldarb', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '124', 'name_ar' => 'الحرث', 'name_en' => 'alharth', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '125', 'name_ar' => 'ضمد', 'name_en' => 'damad', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '126', 'name_ar' => 'الريث', 'name_en' => 'alriyth', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '127', 'name_ar' => 'جزر فرسان', 'name_en' => 'juzur fursan', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '128', 'name_ar' => 'الدائر', 'name_en' => 'alddayir', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '129', 'name_ar' => 'العارضة', 'name_en' => 'alearida', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '130', 'name_ar' => 'أحد المسارحة', 'name_en' => 'ahd almusaraha', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '131', 'name_ar' => 'العيدابي', 'name_en' => 'aleidabiu', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '132', 'name_ar' => 'فيفاء', 'name_en' => 'fayfa', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '133', 'name_ar' => 'الطوال', 'name_en' => 'altwal', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '134', 'name_ar' => 'هروب', 'name_en' => 'harub', 'gov_id' => '11', 'deleted_at' => NULL),
            array('id' => '135', 'name_ar' => 'نجران', 'name_en' => 'Najran', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '136', 'name_ar' => 'شرورة', 'name_en' => 'Sharurah', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '137', 'name_ar' => 'حبونا', 'name_en' => 'hubuwnana', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '138', 'name_ar' => 'بدر الجنوب', 'name_en' => 'Badr Al Janoub', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '139', 'name_ar' => 'يدمه', 'name_en' => 'yadamuh', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '140', 'name_ar' => 'ثار', 'name_en' => 'Thar', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '141', 'name_ar' => 'خباش', 'name_en' => 'Khabbash', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '142', 'name_ar' => 'الخرخير', 'name_en' => 'alkharkhir', 'gov_id' => '12', 'deleted_at' => NULL),
            array('id' => '143', 'name_ar' => 'الباحة', 'name_en' => 'Al Bahah', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '144', 'name_ar' => 'بلجرشي', 'name_en' => 'Belgraci', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '145', 'name_ar' => 'المندق', 'name_en' => 'almunadiq', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '146', 'name_ar' => 'المخواة', 'name_en' => 'Al Mahwah', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '147', 'name_ar' => 'قلوة', 'name_en' => 'qulua', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '148', 'name_ar' => 'العقيق', 'name_en' => 'aleaqiq', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '149', 'name_ar' => 'القرى', 'name_en' => 'alquraa', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '150', 'name_ar' => 'غامد الزناد', 'name_en' => 'Gamed  alzinad', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '152', 'name_ar' => 'الحجرة', 'name_en' => 'alhajra', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '153', 'name_ar' => 'بني حسن', 'name_en' => 'Bani Hassan', 'gov_id' => '13', 'deleted_at' => NULL),
            array('id' => '154', 'name_ar' => 'سكاكا', 'name_en' => 'Skaka', 'gov_id' => '15', 'deleted_at' => NULL),
            array('id' => '155', 'name_ar' => 'القريات', 'name_en' => 'alquriyat', 'gov_id' => '15', 'deleted_at' => NULL),
            array('id' => '156', 'name_ar' => 'دومة الجندل', 'name_en' => 'dawmat aljundal', 'gov_id' => '15', 'deleted_at' => NULL),
            array('id' => '157', 'name_ar' => 'طبرجل', 'name_en' => 'Tabargal', 'gov_id' => '15', 'deleted_at' => NULL),
            array('id' => '158', 'name_ar' => 'الحرجة', 'name_en' => 'alharija', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '159', 'name_ar' => 'بارق', 'name_en' => 'bariq', 'gov_id' => '6', 'deleted_at' => NULL),
            array('id' => '160', 'name_ar' => 'المربع', 'name_en' => 'Al mouraba', 'gov_id' => '1', 'deleted_at' => NULL),
            array('id' => '161', 'name_ar' => 'الرين', 'name_en' => 'alriyn', 'gov_id' => '1', 'deleted_at' => NULL)
        );

        \App\Models\Gov::insert($govs);
        \App\Models\Area::insert($areas);
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
