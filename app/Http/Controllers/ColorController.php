<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Property;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_colors|view_colors|add_colors|edit_colors|delete_colors,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_colors,system_admin', ['only' => ['create','showCreateView','addNewColor']]);
        $this->middleware('permission:edit_colors,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_colors,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request){
        $o =Color::orderBy('id','DESC');
        if($request->name){
            $o->where('name_en', 'like' ,'%'.$request->name.'%')
                ->orWhere('name_ar', 'like' ,'%'.$request->name.'%');
        }
        $out=$o->paginate(20);

        return view('system_admin.colors.index',compact('out'));
    }


    public function showCreateView(){

        return view('system_admin.colors.create');

    }

    public function create(Request $request){


        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:colors,name_ar'],
            'name_en' =>['required',new ValidString(),'max:30','unique:colors,name_en'],
            'hexa' => 'required',

        ]);

        $out=new Color();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->hexa = $request->hexa;
        $out->status = 1;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.colors.index');

    }


    public function showUpdateView(Request $request){
        $out=Color::find($request->id);
        return view('system_admin.colors.update',compact('out'));

    }

    public function Update(Request $request,$id){

        $out= Color::find($id);
        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:colors,name_ar,'.$out->id],
            'name_en' =>['required',new ValidString(),'max:30','unique:colors,name_en,'.$out->id],
            'hexa' => 'required',
        ]);


        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->hexa = $request->hexa;
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.colors.index');
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
            $o = Color::find($id);
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
            $o = Color::find($id);
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
            $c=Color::find($id);
            if($c->can_del){
                $c->delete();
            }
        }
        return ['done'=>1];

    }

    public function addNewColor(Request $request){


        $this->validate($request, [
            'color_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:colors,name_ar'],
            'color_en' =>['required',new ValidString(),'max:30','unique:colors,name_en'],
            'hexa' => 'required',

        ]);

        $out=new Color();
        $out->name_ar=$request->color_ar;
        $out->name_en=$request->color_en;
        $out->hexa = $request->hexa;
        $out->status = 1;
        $out->save();
        if ($out){
            $color = Color::where('id',$out->id)->get()->pluck("name_ar", "id")->toArray();
        }
        return response()->json($color);

    }

}
