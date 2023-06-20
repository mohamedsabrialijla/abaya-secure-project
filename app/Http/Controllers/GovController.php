<?php

namespace App\Http\Controllers;


use App\Models\Gov;
use App\Models\Size;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class GovController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_govs|add_govs|edit_govs|delete_govs,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_govs,system_admin', ['only' => ['create','showCreateView','addNewSize']]);
        $this->middleware('permission:edit_govs,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_govs,system_admin', ['only' => ['delete']]);
    }
    public function index(Request $request){

        $o =Gov::orderBy('id','DESC');
        if($request->name){
            $o->where('name_en', 'like' ,'%'.$request->name.'%')
                ->orWhere('name_ar', 'like' ,'%'.$request->name.'%');
        }
        $out=$o->paginate(20);

        return view('system_admin.govs.index',compact('out'));
    }


    public function showCreateView(){

        return view('system_admin.govs.create');

    }

    public function create(Request $request){

        $this->validate($request,
            [
            'name_ar' => ['required','max:30',
            Rule::unique('govs', 'name_ar')->whereNull('deleted_at')
            ],
            'name_en' =>['required','max:30',
            Rule::unique('govs', 'name_en')->whereNull('deleted_at')
            ],
        ]);
        
        $out=new Gov();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->country_id = 1;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.govs.index');

    }


    public function showUpdateView(Request $request){
        $out=Gov::find($request->id);
        return view('system_admin.govs.update',compact('out'));

    }

    public function Update(Request $request,$id){

        $out= Gov::find($id);

        $this->validate($request, [
            'name_ar' => ['required','max:30',
            Rule::unique('govs', 'name_ar')->ignore($id)->whereNull('deleted_at')
        ],
            'name_en' =>['required','max:30',
            Rule::unique('govs', 'name_en')->ignore($id)->whereNull('deleted_at')
        ],
        
    ]);

        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.govs.index');
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
            $c=Gov::find($id);
            if(!$c->areas()->exists()){
                $c->delete();
            }else
                return null;
        }
        return ['done'=>1];

    }


}
