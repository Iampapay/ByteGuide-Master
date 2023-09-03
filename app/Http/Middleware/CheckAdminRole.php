<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $permission) {
		$admin = Auth::guard('admin')->user();
		if ($admin->is_super_admin == 1) {
			return $next($request);
		} elseif ($admin->is_admin == 1) {

			if (!$admin->hasAccess([$permission])) {
				return response()->view('errors.unauthorize');
			}
			return $next($request);
		}
		return $next($request);
	}
}
