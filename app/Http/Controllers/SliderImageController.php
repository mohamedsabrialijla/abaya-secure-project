<?php

namespace App\Http\Controllers;

use App\Models\SliderImage;
use Illuminate\Http\Request;

class SliderImageController extends Controller
{
    public function index(){
           $out= SliderImage::get();
           return view('system_admin.slider.index',compact('out'));
    }


    public function store(Request $request){
        $request->validate(['image'=>'required']);

        if($request->filled('image')){
            $out=new SliderImage();
            $out->name = $request->image;
            $out->save();
            \HELPER::deleteUnUsedFile([$request->feature_image]);
            flash('تم حفظ الصورة بنجاح','success');
        }

        return redirect()->route('system.slider.index')->with($request->all());
    }


    public function delete(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $s = SliderImage::find($id);
            unlink("./uploads/" . $s->name);
            $s->delete();
        }
        return ['done' => 1];
    }
}
