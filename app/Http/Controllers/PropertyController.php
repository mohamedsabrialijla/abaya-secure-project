<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request){

        $out =Property::paginate(20);

        return view('system_admin.properties.index',compact('out'));
    }


    public function showCreateView(){

        return view('system_admin.properties.create');

    }

    public function create(Request $request){

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' =>['required',new ValidString(),'max:30'],


        ]);

        $out=new Property();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->key = Str::snake($request->name_en);
        $out->status = 1;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.properties.index');

    }



    public function showUpdateView(Request $request){
        $out=Property::find($request->id);
        return view('system_admin.properties.update',compact('out'));

    }

    public function Update(Request $request,$id){

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' => ['required',new ValidString(),'max:30'],

        ]);

        $out= Property::find($id);
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->key = Str::snake($request->name_en);
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.properties.index');
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
            $o = Property::find($id);
            $o->status=1;
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
            $o = Property::find($id);
            $o->status=2;
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
            $c=Property::find($id);
            if($c->can_del){
                $c->delete();
            }
        }
        return ['done'=>1];

    }

}
