<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Page;
use App\Models\Settings;
use App\Models\SliderImage;
use App\Rules\ValidMobile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{

    public function gotoIndex()
    {
        return redirect()->route('website.home');
    }
    public function index(Request $request)
    {
         // $exitCode = Artisan::call('route:clear');
            //return 'Routes cache cleared';
        $sliders=SliderImage::get();
        $setting=new Settings();
        $about_us=$setting->valueOf('about_us_ar');
        $ios=$setting->valueOf('ios');
        $android=$setting->valueOf('android');
       return view("website.homepage",compact('sliders','about_us','ios','android'));
    }



    public function register(Request $request)
    {
        return view("website.register",['register' => "activ"]);
    }


    public function contactUs(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'details' => 'required',
        ]);
        $new=new Contact();


        $new->email=$request->email;
        $new->details=$request->details;
        $new->save();
        flash('تم اضافة طلبك بنجاح');
        return redirect('/');
    }


    public function show_page($id)
    {
        $page=Page::findOrFail($id);
        return view('website.page',compact('page'));
    }

    public function show_register(Request $request)
    {

        return view("website.register");
    }


    public function blocked()
    {
        flash('انت محظور','error');
        return redirect('/');

    }
    public function do_activate()
    {
        flash('الرجاء تفعيل حسابك','error');
        return view('website.active');

    }

    public function web()
    {

        return view('website.products');
    }




}
