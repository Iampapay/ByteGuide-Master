<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller {
	public function index(Request $request) {
		$title = 'Admin | Dashboard';
		return view('dashboard', compact('title'));
	}
}
