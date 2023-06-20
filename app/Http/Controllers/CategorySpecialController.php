<?php

namespace App\Http\Controllers;

use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategorySpecialController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:activate_categories|view_categories|add_categories|edit_categories|delete_categories,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_categories,system_admin', ['only' => ['create','showCreateView']]);
        $this->middleware('permission:edit_categories,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_categories,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request){

        $o=Category::withCount('products')->where('full_width',1)->orderBy('id','DESC');
        if($request->name){
            $o->where('name_en', 'like' ,'%'.$request->name.'%')
                ->orWhere('name_ar', 'like' ,'%'.$request->name.'%');
        }

        $out=$o->paginate(20);
        $out->appends($request->all());
        return view('system_admin.categories_special.index',compact('out'));
    }


    public function showCreateView(){

        return view('system_admin.categories_special.create');

    }


    public function create(Request $request){

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' =>['required',new ValidString(),'max:30'],
            'image' => 'required',

        ]);
        
        // return $request->all();
        // sdkfgdkg

        $out=new Category();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->full_width=1;
        $out->logo=$request->image;
        $out->save();


       


        \HELPER::deleteUnUsedFile([$request->image]);

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.categories_special.index');

    }



    public function showUpdateView(Request $request){
        $out=Category::find($request->id);
        $products = Product::query()->get();
        return view('system_admin.categories_special.update',compact('out','products'));

    } 

    public function Update(Request $request,$id){
        // return $request->all();

        $this->validate($request, [
            'name_ar' =>  ['required',new ValidStringArabic(),'max:30'],
            'name_en' => ['required',new ValidString(),'max:30'],
            'image' => 'required',

        ]);

        $out=Category::find($id);
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->logo=$request->image;
        $out->full_width=1;
        
        $out->save();
        
        
         if(isset($request->products) && $request->products != ''){

            foreach ($request->products as $key => $product) {
                $pro = Product::where('id',$product)->update(['category_id'=>$out->id]);
            }
        }



        \HELPER::deleteUnUsedFile([$request->image]);

        flash('تم التعديل بنجاح');

        return redirect()->route('system.categories_special.index');

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
            $o = Category::find($id);
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
            $o = Category::find($id);
            $o->status=0;
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
            $c=Category::find($id);
            if($c->can_del){
                $c->delete();
            }
        }
        return ['done'=>1];

    }


    public function createJson(Request $request){

        $this->validate($request, [
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',

        ]);

        $out=new Category();
        $out->name_ar=$request->name_ar;
        $out->name_en=$request->name_en;
        $out->logo='';
        $out->save();
        $cats=Category::all();
        $out = '<option value="">اختر التصنيف </option>';
        $out.='<option value="AddNewToList" > اضافة عنصر جديد</option>';

        foreach ($cats as $m) {
            $out .= "<option value='$m->id'>$m->name </option> ";
        }
        return ['done'=>1,'out'=>$out];

    }

}
