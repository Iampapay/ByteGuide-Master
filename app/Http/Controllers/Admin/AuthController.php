<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	public function showLogin()
	{

		$title = 'Admin-login';
		return view('auth.login', compact('title'));
	}

	public function storeLogin(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
			'captcha' => 'required|captcha'
		]);
		if (!Auth::guard('admin')->attempt([
			'email' => $request->email,
			'password' => $request->password,
			'is_super_admin' => 1
		])) {
			Session::flash('msg', ['status' => 'danger', 'msgs' => "Email and password doesn't match!"]);
			return back();
		}
		Session::flash('msg', ['status' => 'success', 'msgs' => "Welcome to Dashboard " . Auth::guard('admin')->user()->name]);
		return redirect()->route('admin.dashboard');
	}

	public function logout()
	{
		if (Auth::guard('admin')->check()) {
			Auth::guard('admin')->logout();
			return redirect()->route('admin.login');
		} else if (Auth::guard('centre')->check()) {
			Auth::guard('centre')->logout();
			return redirect()->route('centre.login');
		}
	}

	//generate captcha
	public function reloadCaptcha()
	{
		return response()->json(['captcha' => captcha_img()]);
	}
}
