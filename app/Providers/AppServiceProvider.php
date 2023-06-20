<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Models\Settings;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Carbon::setLocale(app()->getLocale());
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);


        Blade::directive('old', function ($name,$def='') {
            return '<?php

                  echo old('.$name.' ,"'.$def.'");


                 ?>';
        });
//        Blade::directive('cando',function($text){
//            return '<?php
//
//                  if(\Auth::guard("system_admin")->user()->hasRole('.$text.')):
//
/*                 ?>';*/
//        });
//        Blade::directive('elsecando', function () {
/*            return '<?php else: ?>';*/
//        });
//        Blade::directive('endcando', function () {
/*            return '<?php endif ?>';*/
//        });
        Blade::directive('show_error', function ($name='',$bag='') {

            if($bag){
                return '
            <?php


                if ($errors->'.$bag.'->has('.$name.')){
                    echo \'<span class="help-block has-error"> <strong>\'.$errors->'.$bag.'->first('.$name.').\'</strong></span>\'  ;
                }


            ?>';

            }else{
                return '
            <?php


                if ($errors->has('.$name.')){
                    echo \'<span class="help-block has-error"> <strong>\'.$errors->first('.$name.').\'</strong></span>\'  ;
                }


            ?>';
            }


        });
        Blade::directive('has_error', function ($name='',$bag='') {
            if($bag){
                return '
            <?php

                if ($errors->'.$bag.'->has('.$name.')){
                   echo "has_error"  ;
                }
            ?>';

            }else{

                return '
            <?php


                if ($errors->has('.$name.')){
                    echo "has_error"  ;
                }


            ?>';
            }

        });


//        try {
//            \DB::connection()->getPdo();
//            $conf = Settings::all();
//            $config = [];
//            foreach ($conf as $c) {
//                $config[$c->name] = $c->value;
//            }
//            View::share('config', $config);
//        } catch (\Exception $e) {
//
//        }

    }

}
