<?php

namespace App\Http\Controllers;


use App\Models\CaseGeneral;
use App\Models\Gov;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderCase;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function index()
    {
        $users = User::query()->count();
        $orders = Order::query()->count();
        $products= Product::query()->count();
        return view('system_admin.reports.main-index',compact('users','orders','products'));

    }


    public function report1(Request $request)
    {
        $o=Order::orderBy('id','DESC');
        $sq=0;
        if($request->status > -1){
            $sq=1;
            $o->where('case_id',$request->status);
        }

        if($request->date_from){
            $sq=1;

            $o->where('created_at','>=',Carbon::parse($request->date_from)->startOfDay());
        }
        if($request->date_to){
            $o->where('created_at','<=',Carbon::parse($request->date_to)->endOfDay());
        }
        if($request->price_from){
            $sq=1;

            $o->where('total_price','>=',$request->price_from);
        }
        if($request->price_to){
            $sq=1;

            $o->where('total_price','<=',$request->price_to);
        }

        if($request->name){
            $sq=1;

            $o->where('name','like','%'.$request->name."%");
        }
        if($sq==0 && !isset($_GET['date_from'])){
            $o->where('created_at','>=',Carbon::now()->startOfDay());
            $_GET['date_from']=Carbon::now()->startOfDay()->toDateString();
            $_GET['date_to']=Carbon::now()->startOfDay()->toDateString();
        }
        $out=$o->paginate(40);
        $cases=CaseGeneral::all();
        return view('system_admin.reports.r1',compact('out','cases'));
    }

    public function report2(Request $request)
    {
        $o=Order::where('type',0)->orderBy('id','DESC');
        $sq=0;
        if($request->status > -1){
            $sq=1;
            $o->where('case_id',$request->status);
        }

        if($request->date_from){
            $sq=1;

            $o->where('created_at','>=',Carbon::parse($request->date_from)->startOfDay());
        }
        if($request->date_to){
            $o->where('created_at','<=',Carbon::parse($request->date_to)->endOfDay());
        }
        if($request->price_from){
            $sq=1;

            $o->where('total_price','>=',$request->price_from);
        }
        if($request->price_to){
            $sq=1;

            $o->where('total_price','<=',$request->price_to);
        }

        if($request->name){
            $sq=1;

            $o->where('name','like','%'.$request->name."%");
        }
        if($sq==0 && !isset($_GET['date_from'])){
            $o->where('created_at','>=',Carbon::now()->startOfDay());
            $_GET['date_from']=Carbon::now()->startOfDay()->toDateString();
            $_GET['date_to']=Carbon::now()->startOfDay()->toDateString();
        }
        $out=$o->paginate(40);
        $cases=OrderCase::all();
        return view('system_admin.reports.r2',compact('out','cases'));
    }
    public function report3(Request $request)
    {
        $o=Product::orderBy('id','DESC');
        $sq=0;
        if($request->status > -1){
            $sq=1;
            $o->where('status',$request->status);
        }
        if($request->price_from){
            $sq=1;
            $o->where('price','>=',$request->price_from);
        }
        if($request->price_to){
            $sq=1;
            $o->where('price','<=',$request->price_to);
        }

        if($request->name){
            $sq=1;
            $o->where('name','like','%'.$request->name."%");
        }
        if($sq==0 && !isset($_GET['date_from'])){
            $o->where('created_at','>=',Carbon::now()->startOfDay());
            $_GET['date_from']=Carbon::now()->startOfDay()->toDateString();
            $_GET['date_to']=Carbon::now()->startOfDay()->toDateString();
        }
        $out=$o->paginate(40);
        return view('system_admin.reports.r3',compact('out'));
    }


    public function report5(Request $request)
    {

        $o=User::query()->orderBy('id','DESC');
        if($request->status > -1){
            $o->where('status',$request->status);
        }
        if($request->date_from){
            $o->where('created_at','>=',Carbon::parse($request->date_from)->toDateString());
        }
        if($request->date_to){
            $o->where('created_at','<=',Carbon::parse($request->date_to)->toDateString());
        }

        if($request->name){
            $o->where('name','like','%'.$request->name."%");
        }
        if($request->gov_id>-1){
            $o->where('gov_id',$request->gov_id);
        }
        if($request->area_id>-1){
            $o->where('area_id',$request->area_id);
        }
        $out=$o->paginate(40);
        $govs = Gov::all();
        return view('system_admin.reports.r5',compact('out','govs'));
    }







}
