<?php

namespace App\Http\Controllers;


use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{



    public function index()
    {
        $pages = Page::all();
        return view('system_admin.pages.pageSelect', compact('pages'));

    }

    public function showCreateView()
    {
        dd('no create');

        return view('system_admin.services.create');
    }


    public function showUpdateView($id)
    {
        $page = Page::findOrFail($id);
        return view('system_admin.pages.page', compact('page'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'title_ar'=>'required',
            'text_ar_html'=>'required',
            'text_en_html'=>'required',
        ]);

        if ($page = Page::where('id', $id)->first()) {

            $page->title_ar =$request->title_ar;
            $page->title_en =$request->title_en;
            $page->text_ar =$request->text_ar_html;
            $page->text_en =$request->text_en_html;
            $page->save();
        } else {
            flash('هناك مشكلة ما');
            return back();
        }
        flash('تم التعديل بنجاح');

        return redirect(route('system.pages.index'));
    }


}
