<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		switch ($guard) {
			case 'admin':
				if (Auth::guard($guard)->check() /*&& Auth::guard($guard)->user()->role == 1*/) {
					return redirect()->back();
				}
				break;
			case 'centre':
				if (Auth::guard($guard)->check()) {
					return redirect()->back();
				}
				break;
			default:
				if (Auth::guard($guard)->check()) {
					return redirect()->back();
				}
				break;
		}

		return $next($request);
	}
}
