<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use App\Models\Property;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClothesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_clothes|view_clothes|add_clothes|edit_clothes|delete_clothes,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_clothes,system_admin', ['only' => ['create','showCreateView','addNewClothes']]);
        $this->middleware('permission:edit_clothes,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_clothes,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request){
        $o =Clothes::orderBy('id','DESC');
        if($request->name){
            $o->where('name_en', 'like' ,'%'.$request->name.'%')
                ->orWhere('name_ar', 'like' ,'%'.$request->name.'%');
        }
        $out=$o->paginate(20);

        return view('system_admin.clothes.index',compact('out'));
    }


    public function showCreateView(){

        return view('system_admin.clothes.create');

    }

    public function create(Request $request){


        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:clothes,name_ar'],
            'name_en' =>['required',new ValidString(),'max:30','unique:clothes,name_en'],
            // 'hexa' => 'required',

        ]);

        $out=new Clothes();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->slug_ar = str_replace(" ","-",trim($request->name_ar));
        $out->slug_en = str_replace(" ","-",trim($request->name_en));
        $out->status = 1;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.clothes.index');

    }


    public function showUpdateView(Request $request){
        $out=Clothes::find($request->id);
        return view('system_admin.clothes.update',compact('out'));

    }

    public function Update(Request $request,$id){

        $out= Clothes::find($id);
        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:clothes,name_ar,'.$out->id],
            'name_en' =>['required',new ValidString(),'max:30','unique:clothes,name_en,'.$out->id],
            // 'hexa' => 'required',
        ]);


        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->slug_ar = str_replace(" ","-",trim($request->name_ar));
        $out->slug_en = str_replace(" ","-",trim($request->name_en));
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.clothes.index');
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
            $o = Clothes::find($id);
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
            $o = Clothes::find($id);
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
            $c=Clothes::find($id);
            if($c->can_del){
                $c->delete();
            }
        }
        return ['done'=>1];

    }

    public function addNewClothes(Request $request){

// dd($request->all());
        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:clothes,name_ar'],
            'name_en' =>['required',new ValidString(),'max:30','unique:clothes,name_en'],

        ]);

        $out=new Clothes();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->slug_ar = str_replace(" ","-",trim($request->name_ar));
        $out->slug_en = str_replace(" ","-",trim($request->name_en));
        $out->status = 1;
        $out->save();
        if ($out){
            $clothes = Clothes::where('id',$out->id)->get()->pluck("name_ar", "id")->toArray();
        }
        return response()->json($clothes);

    }

}
