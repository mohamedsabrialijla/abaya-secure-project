<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MYHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public static function send_sms($mobile, $text)
    {
//        $mobile=str_replace_first('05','9725',$mobile);
//        $mobile=str_replace_first('05','9665',$mobile);
//        $url = "http://www.hotsms.ps/sendbulksms.php?user_name=selsela&user_pass=2506023&text=".$messgmobile."&mobile=".$mobile."&sender=selsela&type=2" ;


//        $messgmobile = urlencode($text);
//        $url = "http://www.hotsms.ps/sendbulksms.php?user_name=selsela&user_pass=2506023&text=".$messgmobile."&mobile=".$mobile."&sender=selsela&type=2" ;
//        if(substr($mobile,0,3) == '965'){
//            $url = "https://rest.nexmo.com/sms/json?api_key=dc1122b2&api_secret=bhdA74hPc0gGP3hR&text=".$messgmobile."&to=".$mobile."&from=Nexmo&type=unicode" ;
//
//        }
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_URL, $url);
//        return curl_exec($ch);
    }
    public static function set_active($path)
    {
//        if (request()->is("admin/system/$path*")) {
//            return '  m-menu__item--active ';
//        }else{
//            return '';
//        }
        $currentRoute=\Illuminate\Support\Facades\Route::current()->getPrefix();
        $name=route($path);
        if(url($currentRoute) == $name){
            return '  m-menu__item--active ';
        }
        return '';
    }
    public static function set_if(&$var, $ret = '', $prefix = '')
    {
        if (isset($var)) {
            return $prefix . $var;
        } else {
            return $ret;
        }
    }
    public static function deleteTEMP(){
        $currentRoute=\Illuminate\Support\Facades\Route::current();
        if($_SERVER['REQUEST_URI']){
            $currentMode=$_SERVER['REQUEST_URI'];

            $function_name =$_SERVER['REQUEST_URI'];
            echo $function_name;
            if(str_contains($currentMode,'admin')){
                if(str_contains($function_name,'index')){
                    $temp=session('tempImage');
                    if(is_array($temp))
                        foreach ($temp as $t){
                            try {
                                unlink("./public/uploads/".$t);
//                                unlink("./public/uploads/thumbnail/".$t);
                            }catch (\Exception $e){}

                        }
                    session(['tempImage'=>[]]);

                    $temp=session('tempMultiImage');
                    if(is_array($temp))
                        foreach ($temp as $t){
                            try {
                                unlink("./public/uploads/".$t);
//                                unlink("./public/uploads/thumbnail/".$t);
                            }catch (\Exception $e){}
                        }
                    session(['tempMultiImage'=>[]]);
                    return true;
                }
            }}


        return true;
    }

    public static function deleteUnUsedFile($image){
        $temp=session('tempImage');
        if(is_array($image)){
            if(is_array($temp))
                foreach ($temp as $t){
                    if(array_search($t,$image) === false){
                        try {
                            unlink("./public/uploads/".$t);
//                            unlink("./public/uploads/thumbnail/".$t);
                        }catch (\Exception $e){}
                    }

                }
            session(['tempImage'=>[]]);
            return true;
        }else{
            if(is_array($temp))
                foreach ($temp as $t){
                    if($t != $image){
                        try {
                            unlink("./public/uploads/".$t);
//                            unlink("./public/uploads/thumbnail/".$t);
                        }catch (\Exception $e){}
                    }

                }
            session(['tempImage'=>[]]);
            return true;
        }

    }


    public static function deleteUnUsedFiles($images){
        $temp=session('tempMultiImage');
        if(is_array($temp))
            foreach ($temp as $t){
                if(! in_array($t,$images)){
                    try {
                        unlink("./public/uploads/".$t);
//                        unlink("./public/uploads/thumbnail/".$t);
                    }catch (\Exception $e){}
                }

            }
        session(['tempMultiImage'=>[]]);
        return true;
    }


    public static function endWith($str, $lastString)
    {
        $count = strlen($lastString);
        if ($count == 0) {
            return true;
        }
        return (substr($str, -$count) === $lastString);
   }



}
