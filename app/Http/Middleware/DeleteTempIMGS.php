<?php

namespace App\Http\Middleware;

use Closure;

class DeleteTempIMGS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        self::deleteTEMP();

        return $response;
    }
    public static function deleteTEMP(){

        $currentRoute=\Illuminate\Support\Facades\Route::current();
        if($currentRoute){
            if(isset($currentRoute->action['controller'])){
                $currentMode=$currentRoute->action['controller'];
                if(isset($currentRoute->action['prefix'])){
                    $currentprefix=$currentRoute->action['prefix'];
                    // session(['tempImage'=>[]]);
                    if($currentprefix && str_contains($currentprefix,'admin')){
                        if(str_contains($currentMode,'index')){
                            // session(['tempImage'=>[]]);
                            $temp=session('tempImage');

                            if(is_array($temp))
                                foreach ($temp as $t){
                                    try{
                                        unlink("./uploads/".$t);
                                        unlink("./uploads/thumbnail/".$t);

                                    }catch (\Exception $e){}
                                }
                            session(['tempImage'=>[]]);

                            $temp=session('tempMultiImage');
                            if(is_array($temp))
                                foreach ($temp as $t){
                                    try{
                                        unlink("./uploads/".$t);
                                        unlink("./uploads/thumbnail/".$t);

                                    }catch (\Exception $e){}
                                }
                            session(['tempMultiImage'=>[]]);
                            return true;
                        }
                    }}
                }


        }


        return true;
    }
}
