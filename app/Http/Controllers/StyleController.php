<?php

namespace App\Http\Controllers;

use App\Models\Style;
use App\Models\Property;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StyleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_style|view_style|add_style|edit_style|delete_style,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_style,system_admin', ['only' => ['create','showCreateView','addNewStyle']]);
        $this->middleware('permission:edit_style,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_style,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request){
        $o =Style::orderBy('id','DESC');
        if($request->name){
            $o->where('name_en', 'like' ,'%'.$request->name.'%')
                ->orWhere('name_ar', 'like' ,'%'.$request->name.'%');
        }
        $out=$o->paginate(20);

        return view('system_admin.style.index',compact('out'));
    }


    public function showCreateView(){

        return view('system_admin.style.create');

    }

    public function create(Request $request){


        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:style,name_ar'],
            'name_en' =>['required',new ValidString(),'max:30','unique:style,name_en'],
            // 'hexa' => 'required',

        ]);

        $out=new Style();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->slug_ar = str_replace(" ","-",trim($request->name_ar));
        $out->slug_en = str_replace(" ","-",trim($request->name_en));
        $out->status = 1;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.styles.index');

    }


    public function showUpdateView(Request $request){
        $out=Style::find($request->id);
        return view('system_admin.style.update',compact('out'));

    }

    public function Update(Request $request,$id){

        $out= Style::find($id);
        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:style,name_ar,'.$out->id],
            'name_en' =>['required',new ValidString(),'max:30','unique:style,name_en,'.$out->id],
            // 'hexa' => 'required',
        ]);


        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->slug_ar = str_replace(" ","-",trim($request->name_ar));
        $out->slug_en = str_replace(" ","-",trim($request->name_en));
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.styles.index');
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
            $o = Style::find($id);
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
            $o = Style::find($id);
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
            $c=Style::find($id);
            if($c->can_del){
                $c->delete();
            }
        }
        return ['done'=>1];

    }

    public function addNewStyle(Request $request){


        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30','unique:style,name_ar'],
            'name_en' =>['required',new ValidString(),'max:30','unique:style,name_en'],

        ]);

        $out=new Style();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->slug_ar = str_replace(" ","-",trim($request->name_ar));
        $out->slug_en = str_replace(" ","-",trim($request->name_en));
        $out->status = 1;
        $out->save();
        if ($out){
            $style = Style::where('id',$out->id)->get()->pluck("name_ar", "id")->toArray();
        }
        return response()->json($style);

    }

}
