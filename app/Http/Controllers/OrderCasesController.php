<?php

namespace App\Http\Controllers;

use App\Models\OrderCase;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Http\Request;

class OrderCasesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_orderCases|view_orderCases|add_orderCases|edit_orderCases|delete_orderCases,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_orderCases,system_admin', ['only' => ['create','showCreateView']]);
        $this->middleware('permission:edit_orderCases,system_admin', ['only' => ['showUpdateView','Update']]);
        $this->middleware('permission:delete_orderCases,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {

        $o = OrderCase::orderBy('id', 'asc');

        $out = $o->paginate(20);
        $out->appends($request->all());

        return view('system_admin.order_cases.index', compact('out'));

    }

    public function showCreateView()
    {

        return view('system_admin.order_cases.create');

    }


    public function create(Request $request)
    {

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' =>['required',new ValidString(),'max:30'],
            'details_ar' =>  ['required',new ValidStringArabic()],
            'details_en' =>['required',new ValidString()],
            'hex_color' => 'required',

        ]);

        $out=new OrderCase();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->details_ar=$request->details_ar;
        $out->details_en=$request->details_en;
        $out->hex_color = $request->hex_color;
        $out->is_active = $request->get('is_active') ? 1 : 0;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.orderCases.index');
    }


    public function showUpdateView(Request $request){
        $out=OrderCase::find($request->id);
        return view('system_admin.order_cases.update',compact('out'));

    }


    public function Update(Request $request,$id){

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' =>['required',new ValidString(),'max:30'],
            'details_ar' =>  ['required',new ValidStringArabic()],
            'details_en' =>['required',new ValidString()],
            'hex_color' => 'required',
            'notification_title' => 'required',
            'notification_text' => 'required',

        ]);

        $out= OrderCase::find($id);
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->details_ar=$request->details_ar;
        $out->details_en=$request->details_en;
        $out->hex_color = $request->hex_color;
        $out->notification_title = $request->notification_title;
        $out->notification_text = $request->notification_text;
        $out->is_active = $request->get('is_active') ? 1 : 0;
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.orderCases.index');
    }


    public function activate(Request $request)
    {
        $ids=[];
        if (is_array($request->id)) {
            $ids=$request->id;
        } else {
            $ids[]=$request->id;

        }
        foreach ($ids as $id) {
            $o = OrderCase::find($id);
            $o->is_active=1;
            $o->save();

        }
        return ['done' => 1];

    }

    public function deactivate(Request $request)
    {
        $ids=[];
        if (is_array($request->id)) {
            $ids=$request->id;
        } else {
            $ids[]=$request->id;

        }
        foreach ($ids as $id) {
            $o = OrderCase::find($id);
            $o->is_active=0;
            $o->save();
        }
        return ['done' => 1];

    }


    public function delete(Request $request)
    {
        $ids=[];
        if(is_array($request->id)){
            $ids=$request->id;
        }else{
            $ids[]=$request->id;
        }
        foreach ($ids as $id){
            $c=OrderCase::find($id);
                $c->delete();
        }
        return ['done'=>1];

    }
}
