<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class IsAdmin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		if (Auth::guard('admin')->check()) {
			if ((Auth::guard('admin')->user()->is_admin == 1)) {
				return $next($request);
			} elseif (!Auth::guard('admin')->user()->is_admin) {
				Auth::guard('admin')->logout();
				Session::flash('msg', ['status' => 'danger', 'msgs' => 'You are not Authenticated']);
				return redirect()->route('admin.login');
			}

		}
		Session::flash('msg', ['status' => 'danger', 'msgs' => 'You are not Authenticated']);
		return redirect()->route('admin.login');
	}
}
