<?php

namespace App\Http\Controllers;

use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Http\Request;
use App\Models\Trace;

class TracePaymentController extends Controller
{
    //
    function __construct()
    {
        
    } 

    public function index(Request $request){

        $traces=Trace::query()->orderBy('id','DESC')->get();
        return $traces;

        return view('system_admin.trace.index', compact('traces'));
    }






}
