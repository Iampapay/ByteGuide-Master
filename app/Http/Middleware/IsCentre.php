<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class IsCentre {
   /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('centre')->check()) {
			if ((Auth::guard('centre')->user()->is_admin == 1) && (Auth::guard('centre')->user()->is_super_admin == 0)) {
				return $next($request);
			} elseif (!Auth::guard('centre')->user()->is_admin) {
				Auth::guard('centre')->logout();
				Session::flash('msg', ['status' => 'danger', 'msgs' => 'You are not Authenticated']);
				return redirect()->route('centre.login');
			}

		}
		Session::flash('msg', ['status' => 'danger', 'msgs' => 'You are not Authenticated']);
		return redirect()->route('centre.login');
    }
}
