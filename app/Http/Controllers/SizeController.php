<?php

namespace App\Http\Controllers;


use App\Models\Size;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_sizes|view_sizes|add_sizes|edit_sizes|delete_sizes,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_sizes,system_admin', ['only' => ['create','showCreateView','addNewSize']]);
        $this->middleware('permission:edit_sizes,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_sizes,system_admin', ['only' => ['delete']]);
    }
    public function index(Request $request){

        $o =Size::orderBy('id','DESC');
        if($request->name){
            $o->where('name_en', 'like' ,'%'.$request->name.'%')
                ->orWhere('name_ar', 'like' ,'%'.$request->name.'%');
        }
        $out=$o->paginate(20);

        return view('system_admin.sizes.index',compact('out'));
    }


    public function showCreateView(){

        return view('system_admin.sizes.create');

    }

    public function create(Request $request){


       // $this->validate($request, [
        //    'name_ar' =>  ['required','max:30','unique:sizes,name_ar'],
         //   'name_en' =>['required','max:30','unique:sizes,name_en'],
        //]);

        $this->validate($request, [
            'name_ar' => ['required','max:30',
            Rule::unique('sizes', 'name_ar')->whereNull('deleted_at')
            ],
            'name_en' =>['required','max:30',
            Rule::unique('sizes', 'name_en')->whereNull('deleted_at')
            ],
        ]);
        
        $out=new Size();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->status = 1;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.sizes.index');

    }


    public function showUpdateView(Request $request){
        $out=Size::find($request->id);
        return view('system_admin.sizes.update',compact('out'));

    }

    public function Update(Request $request,$id){

        $out= Size::find($id);

       // $this->validate($request, [
        //    'name_ar' =>  ['required','max:30','unique:sizes,name_ar,'.$out->id],
        //    'name_en' =>['required','max:30','unique:sizes,name_en,'.$out->id],
    //    ]);

        $this->validate($request, [
            'name_ar' => ['required','max:30',
            Rule::unique('sizes', 'name_ar')->ignore($id)->whereNull('deleted_at')
        ],
            'name_en' =>['required','max:30',
            Rule::unique('sizes', 'name_en')->ignore($id)->whereNull('deleted_at')
        ],
        
    ]);

        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.sizes.index');
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
            $o = Size::find($id);
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
            $o = Size::find($id);
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
            $c=Size::find($id);
            if($c->can_del){
                $c->delete();
            }
        }
        return ['done'=>1];

    }


    public function addNewSize(Request $request){

        $this->validate($request, [
            'size_ar' =>  ['required','max:30','unique:sizes,name_ar'],
            'size_en' =>['required','max:30','unique:sizes,name_en'],
        ]);

        $out=new Size();
        $out->name_ar=$request->size_ar;
        $out->name_en=$request->size_en;
        $out->status = 1;
        $out->save();
        if ($out){
            $size = Size::where('id',$out->id)->get()->pluck("name_ar", "id")->toArray();
        }
       return response()->json($size);

    }
}
