<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Http\Request;

class PaymentTypesController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:activate_payments|view_payments|add_payments|edit_payments|delete_payments,system_admin', ['only' => ['index', 'create']]);
        $this->middleware('permission:add_payments,system_admin', ['only' => ['create', 'showCreateView']]);
        $this->middleware('permission:edit_payments,system_admin', ['only' => ['showUpdateView', 'Update']]);
        $this->middleware('permission:delete_payments,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {

        $o = PaymentType::where('id','!=',4)->orderBy('id', 'DESC');

        $out = $o->paginate(20);
        $out->appends($request->all());

        return view('system_admin.payments.index', compact('out'));

    }

    public function showCreateView(){

        return view('system_admin.payments.create');

    }


    public function create(Request $request){

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' =>['required',new ValidString(),'max:30'],
            'image' => 'required',
            'ratio' => ['required','numeric'],

        ]);

        $out=new PaymentType();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->icon=$request->image;
        $out->ratio=$request->ratio;
        $out->save();
        \HELPER::deleteUnUsedFile([$request->image]);

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.payments.index');

    }



    public function showUpdateView(Request $request){
        $out=PaymentType::find($request->id);
        return view('system_admin.payments.update',compact('out'));

    }

    public function Update(Request $request,$id){

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' => ['required',new ValidString(),'max:30'],
            'image' => 'required',
            'ratio' => ['required','numeric'],

        ]);

        $out=PaymentType::find($id);
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->icon=$request->image;
        $out->ratio=$request->ratio;
        $out->save();
        \HELPER::deleteUnUsedFile([$request->image]);

        flash('تم التعديل بنجاح');

        return redirect()->route('system.payments.index');

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
            $c=PaymentType::find($id);

                $c->delete();
        }
        return ['done'=>1];

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
            $o = PaymentType::find($id);
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
            $o = PaymentType::find($id);
            $o->is_active=0;
            $o->save();
        }
        return ['done' => 1];

    }


    public function changeIsActive(Request $request)
    {

        $product = PaymentType::findOrFail($request->id);
        $product->is_active = $request->get('is_active') ? 1 : 0;
        $product->save();

        return ['done' => 1];
    }


}
