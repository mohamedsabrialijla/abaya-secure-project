<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemAdminLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:system_admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('system_admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, ['email' => 'required', 'password' => 'required']);
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (Auth::guard('system_admin')->attempt($credentials, true)) {
            switch (Auth::guard('system_admin')->user()->status) {
                case 1:
                    return redirect()->route('system_admin.dashboard');
                    break;

                case 2:
                    return redirect()->route('system_admin.activation');
                    break;

            }
        }else{
            flash('اسم المستخدم او كلمة المرور خاطئة','error');
        }

        return redirect()->back()->withErrors(['email'=>"اسم المستخدم او كلمة المرور خاطئة"])->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('system_admin')->logout();
//        $request->session()->invalidate();
        return redirect()->route('system_admin.login');
    }
}
