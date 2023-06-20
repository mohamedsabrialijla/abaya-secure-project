<?php

namespace App\Http\Controllers;

use App\Models\DesignerSearchLog;
use App\Models\ProductSearchLog;
use App\SystemAdmin;
use Illuminate\Http\Request;

class SearchLogController extends Controller
{
    //

    public function designerList(){
        $out=DesignerSearchLog::get();
        return view('system_admin.search_log.designer',compact('out'));
    }
    public function productList(){
        $out=ProductSearchLog::get();
        return view('system_admin.search_log.products',compact('out'));
    }
    public function deleteDesignerKeyword(Request $request)
    {
        if(is_array($request->id)){
            foreach ($request->id as $id){
                DesignerSearchLog::destroy($id);
            }
            return ['done'=>1];
        }else{
            $isDeleted = DesignerSearchLog::destroy($request->id);
            return ['done'=>$isDeleted];
        }

    }
    public function deleteProductKeyword(Request $request)
    {
        if(is_array($request->id)){
            foreach ($request->id as $id){
                ProductSearchLog::destroy($id);
            }
            return ['done'=>1];
        }else{
            $isDeleted = ProductSearchLog::destroy($request->id);
            return ['done'=>$isDeleted];
        }

    }


}
