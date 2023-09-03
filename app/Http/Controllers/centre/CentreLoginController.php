<?php

namespace App\Http\Controllers\centre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CentreLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:centre')->except('logout');
    }

    public function showCentreLogin()
    {
        $title = 'Centre-login';
        return view('centre.login', compact('title'));
    }

    public function storeCentreLogin(Request $request)
    {
        if (!Auth::guard('centre')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_admin' => 1,
            'is_super_admin' => 0
        ])) 
        // Auth::guard('centre')->login(;)
        {
            Session::flash('msg', ['status' => 'danger', 'msgs' => "Email and password doesn't match!"]);
            return back();
        }
        Session::flash('msg', ['status' => 'success', 'msgs' => "Welcome to Dashboard " . Auth::guard('centre')->user()->name]);
        return redirect()->route('centre.dashboard');
    }

    public function logout()
    {
        Auth::guard('centre')->logout();
        return redirect()->route('centre.login');
    }
}
