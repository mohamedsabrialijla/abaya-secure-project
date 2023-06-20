<?php

namespace App\Http\Controllers;

use App\Classes\Theme\Metronic;
use App\Models\AdminNotification;
use App\Models\Module;
use App\Models\Page;
use App\Models\Product;
use App\Models\Settings;
use App\Models\SplashImage;
use App\Rules\SnapChat;
use App\Rules\ValidAppleStore;
use App\Rules\ValidFaceBook;
use App\Rules\ValidGooglePlay;
use App\Rules\ValidInstagram;
use App\Rules\ValidMobile;
use App\Rules\ValidNumber;
use App\Rules\ValidSnapChat;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use App\Rules\ValidTwitter;
use App\Rules\ValidUrl;
use App\SystemAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:activate_settings|view_settings|add_settings|edit_settings|delete_settings,system_admin', ['only' => ['index','add']]);
        $this->middleware('permission:activate_about_us|view_about_us|add_about_us|edit_about_us|delete_about_us,system_admin', ['only' => ['getAbout','postAbout']]);
        $this->middleware('permission:activate_terms|view_terms|add_terms|edit_terms|delete_terms,system_admin', ['only' => ['getTerms','postTerms']]);
        $this->middleware('permission:activate_policies|view_policies|add_policies|edit_policies|delete_policies,system_admin', ['only' => ['getPolicy','postPolicy']]);

    }

    public function index()
    {
        $page=[];
        $conf=Settings::all();
        foreach ($conf as $c){
            $page[$c->name]=$c->value;
        }
        return view('system_admin.settings.index',compact('page'));
    }

    public function splashSettingsView(){
        $settings=new Settings();
        $splash_promotion_text_ar=  $settings->valueOf('splash_promotion_text_ar');
        $splash_promotion_text_en=$settings->valueOf('splash_promotion_text_en');
        $splashImages=SplashImage::get();
        return view('system_admin.settings.splash',compact('splash_promotion_text_ar','splash_promotion_text_en','splashImages'));
    }


    public function updateSplashSettings(Request $request)
    {
        $this->validate($request,[
            'splash_promotion_text_ar'=>['required',new ValidStringArabic()],
            'splash_promotion_text_en'=>['required',new ValidString()],

        ]);

        foreach ($request->except(['_token']) as $name=>$value){
            Settings::updateOrCreate(
                ['name' => $name],
                ['name' => $name,'value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
       return  $this->splashSettingsView();
    }

    public function deleteSplashImage(Request $request)
    {
        $s = SplashImage::find($request->id);
        $s->delete();

        return ['done' => 1];


    }

    public function updateSplashImage(Request $request)
    {

        $this->validate($request, [

            'splash_image'=>['required'],

        ]);

        $splashImage=new SplashImage();
            if($request->filled('splash_image')){
                $splashImage->name = $request->splash_image;
                \HELPER::deleteUnUsedFile([$request->splash_image]);
            }
        $splashImage->save();

        flash('تم الإضافة بنجاح');
        return $this->splashSettingsView();
    }
    public function add(Request $request)
    {
        $this->validate($request,[
            'project_name_ar'=>['required',new ValidStringArabic()],
            'project_name_en'=>['required',new ValidString()],
            'currency_ar'=>['required',new ValidStringArabic()],
            'currency_en'=>['required',new ValidString()],
            'ios'=>['required',new ValidUrl()],
            'android'=>['required',new ValidUrl()],
            'return_max_day'=>['required',new ValidNumber()],
            'tax'=>['required',new ValidNumber()],
        ]);

        foreach ($request->except(['_token']) as $name=>$value){
            Settings::updateOrCreate(
                ['name' => $name],
                ['name' => $name,'value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
         return redirect()->back()->with(['active_tab'=>'tab1']);
    }
    public function settingAboutUs(Request $request)
    {
        $this->validate($request,[
            'website_about_us'=>['required'],

        ]);
        foreach ($request->except(['_token']) as $name=>$value){
            Settings::updateOrCreate(
                ['name' => $name],
                ['name' => $name,'value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
        return redirect()->back()->with(['active_tab'=>'tab11']);
    }

    public function updateImage(Request $request)
    {
        $this->validate($request,[
            'sizes_image'=>'required',
        ]);

        foreach ($request->except(['_token']) as $name=>$value){
            Settings::updateOrCreate(
                ['name' => $name],
                ['name' => $name,'value' => $request->sizes_image]
            );
        }

        \HELPER::deleteUnUsedFile([$request->sizes_image]);

        flash('تم التعديل بنجاح');
         return redirect()->back()->with(['active_tab'=>'tab10']);
    }

    public function addMedia(Request $request)
    {
        $this->validate($request,[
            'mobile'=>['required','digits:12','numeric'],
            'email'=>'required|email',
            'address'=>'required|max:50',
            'whatsapp'=>['required','digits:12','numeric'],
            'facebook'=>['nullable'],
            'twitter'=>['nullable'],
            'instagram'=>['nullable'],
            'snapchat' => ['nullable'],
        ]);
        foreach ($request->except(['_token']) as $name=>$value){
            \Cache::clear();
            Settings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
        return redirect()->route('system.settings.index')->with(['active_tab'=>'tab2']);
    }

    public function addShippingCost(Request $request)
    {
        $this->validate($request,[
            'internal_shipping_cost'=>'required|numeric',
            'external_shipping_cost'=>'required|numeric',

        ]);
        foreach ($request->except(['_token']) as $name=>$value){
            \Cache::clear();
            Settings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
        return redirect()->back()->with(['active_tab'=>'tab6']);
    }

    public function addPoints(Request $request)
    {
        $this->validate($request,[
            'referral_register_points'=>'required|numeric',
            'points_to_cash_one_sar'=>'required|numeric',
            'promo_code_discount_ratio'=>'required|numeric|min:0|max:99',
        ]);
        foreach ($request->except(['_token']) as $name=>$value){
            \Cache::clear();
            Settings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
        return redirect()->back()->with(['active_tab'=>'tab7']);
    }




    public function getNotifications(Request $request)
    {
        if($request->only_count == 1){
            $count=AdminNotification::where('seen',0)->count();

            return ['done'=>1,'count'=>$count,'items'=>""];
        }else{
            $all=AdminNotification::query()->whereNotNull('not_data')->orderBy('id','desc')->get();
            $items="";
            foreach($all as $a){
                $seen=$a->seen == 0?'primary':'warning';
                $link="#";


                if($a->not_data){
                    $data = json_decode($a->not_data);
                    if(isset($data->order_id)){
                        $link=route('system.orders.details',$data->order_id);

                    }else{
                        $link='#';
                    }
                }
                $items.='
            <div class="d-flex align-items-center mb-6">

                <div class="symbol symbol-40 symbol-light-'.$seen.' mr-5">
                    <span class="symbol-label">
                        <img src="'.asset('media/svg/icons/Home/Library.svg').'" alt="">
                    </span>
                </div>
                <div class="d-flex flex-column font-weight-bold">
                    <a href="'.$link.'" class="text-dark text-hover-primary mb-1 font-size-lg">'.$a->text.'</a>
                    <span class="text-muted">'.$a->created_at->diffForHumans().'</span>
                </div>
            </div>';


            }

            AdminNotification::where('seen',0)->update(['seen'=>1]);
            return ['done'=>1,'count'=>0,'items'=>$items];
        }


    }




    public function getAbout(){
        $page=[];
        $conf=Settings::all();
        foreach ($conf as $c){
            $page[$c->name]=$c->value;
        }
        return view('system_admin.about_us.page',compact('page'));
    }

    public function postAbout(Request $request){
        $this->validate($request,[
            'about_us_ar'=>['required'],
            'about_us_en'=>['required'],
        ]);
        foreach ($request->except(['_token']) as $name=>$value){
            \Cache::clear();
            Settings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
        return redirect(route('system.settings.getAbout'));
    }


    public function getTerms(){
        $page=[];
        $conf=Settings::all();
        foreach ($conf as $c){
            $page[$c->name]=$c->value;
        }
        return view('system_admin.terms_and_conditions.page',compact('page'));
    }

    public function postTerms(Request $request){
        $this->validate($request,[
            'terms_and_conditions_ar'=>['required'],
            'terms_and_conditions_en'=>['required'],
        ]);
        foreach ($request->except(['_token']) as $name=>$value){
            \Cache::clear();
            Settings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
        return redirect(route('system.settings.getTerms'));
    }


    public function getPolicy(){
        $page=[];
        $conf=Settings::all();
        foreach ($conf as $c){
            $page[$c->name]=$c->value;
        }
        return view('system_admin.privacy_and_policy.page',compact('page'));
    }

    public function postPolicy(Request $request){
        $this->validate($request,[
            'privacy_and_policy_ar'=>['required'],
            'privacy_and_policy_en'=>['required'],
        ]);
        foreach ($request->except(['_token']) as $name=>$value){
            \Cache::clear();
            Settings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }
        flash('تم التعديل بنجاح');
        return redirect(route('system.settings.getPolicy'));
    }



    public function system_settings()
    {
        return view('system_admin.settings.actions');
    }

    public function exportDB(Request  $request)
    {
        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password =config('database.connections.mysql.password');
        $database_name = config('database.connections.mysql.database');
        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");


// Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {

            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            $sqlScript .= "\n\nDROP TABLE IF EXISTS `$table`;";
            $sqlScript .= "\n" . $row[1] . ";\n\n";


            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);

            $columnCount = mysqli_num_fields($result);

            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i ++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j ++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            if(is_numeric($row[$j])){
                                $sqlScript .= $row[$j] ;

                            }elseif(is_null($row[$j])){
                                $sqlScript .= "NULL" ;

                            }else{
                                $sqlScript .= "'" . $row[$j] . "'";

                            }
                        } else {
                            $sqlScript .= "NULL";
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\n";
        }

        if(!empty($sqlScript)) {
            $base=base_path();
            $dir0=$base.'/public/db_back';
            $dir=date('Y');
            $dir2=date('M');
            $dir3=date('d');
            if( is_dir($dir0) === false )
            {
                mkdir($dir0);
            }
            if( is_dir($dir0.'/'.$dir) === false )
            {
                mkdir($dir0.'/'.$dir);
            }
            if( is_dir($dir0.'/'.$dir. '/'.$dir2) === false )
            {
                mkdir($dir0.'/'.$dir. '/'.$dir2);
            }
            if( is_dir($dir0.'/'.$dir. '/'.$dir2. '/'.$dir3) === false )
            {
                mkdir($dir0.'/'.$dir. '/'.$dir2. '/'.$dir3);
            }
            // Save the SQL script to a backup file
            $backup_file_name = $database_name . '_backup' . '.sql';
            $fileHandler = fopen($dir0 . '/'.$dir . '/'.$dir2 . '/'.$dir3 . '/'.$backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler);
            return response()->download($dir0 . '/'.$dir . '/'.$dir2 . '/'.$dir3 . '/'.$backup_file_name);

        }
    }

    public function trancateDB(Request  $request)
    {



        $tableNames = \Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        $except=['areas','balance_types','cases','countries ',
            'govs','image_types','languages','ltm_translations',
            'migrations','notifications_texts','pages',
            'payment_types','rules','settings','system_admins'];
        foreach ($tableNames as $name){
            if (in_array($name, $except, true)) {
                continue;
            }
            Schema::disableForeignKeyConstraints();
            \DB::table($name)->truncate();
            Schema::enableForeignKeyConstraints();

        }
        foreach (Settings::all() as $c){
            if($c->show_edit){
                $c->value='';
                $c->save();
            }
        }
        foreach (Page::all() as $c){
            $c->text_ar='';
            $c->text_en='';
            $c->save();

        }
        SystemAdmin::where('id','<>',1)->delete();
        foreach (config('menu_aside.items') as $item){
            if(isset($item['module_name']) && isset($item['title'])){
                $has_multi=0;
                if(is_array($item['module_name'])){
                    $has_multi=1;
                    $where=collect($item['module_name'])->map(function ($item){
                        return strtolower(trim($item));
                    });
                }else{
                    $where=[strtolower(trim($item['module_name']))];
                }
                foreach ($where as $w){
                    if($n=Module::where('name',$w)->first()){
                        if($has_multi){
                            $n->nameAr=$item['title'].'-'.$w;

                        }else{
                            $n->nameAr=$item['title'];
                        }
                        $n->save();
                    }else{
                        $n=new Module();
                        $n->name=$w;
                        if($has_multi){
                            $n->nameAr=$item['title'].'-'.$w;

                        }else{
                            $n->nameAr=$item['title'];
                        }
                        $n->save();
                    }
                }

            }


        }
        flash('تم تفريغ قاعدة البيانات بنجاح');
        return back();
    }




    public function reload_modules()
    {
        Module::truncate();
        foreach (config('menu_aside.items') as $item){
            if(isset($item['module_name']) && isset($item['title'])){
                $has_multi=0;
                if(is_array($item['module_name'])){
                    $has_multi=1;
                    $where=collect($item['module_name'])->map(function ($item){
                        return strtolower(trim($item));
                    });
                }else{
                    $where=[strtolower(trim($item['module_name']))];
                }
                foreach ($where as $w){
                    if($n=Module::where('name',$w)->first()){
                        if($has_multi){
                            $n->nameAr=$item['title'].'-'.$w;

                        }else{
                            $n->nameAr=$item['title'];
                        }
                        $n->save();
                    }else{
                        $n=new Module();
                        $n->name=$w;
                        if($has_multi){
                            $n->nameAr=$item['title'].'-'.$w;

                        }else{
                            $n->nameAr=$item['title'];
                        }
                        $n->save();
                    }
                }

            }


        }
    }

}
