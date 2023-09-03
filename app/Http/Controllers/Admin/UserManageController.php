<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CityMst;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use Auth;

class UserManageController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = 'Users List';
		$users = User::orderBy('id', 'desc')->paginate(10);
		return view('user-manage.index', compact('title', 'users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{

		$title = 'User create';
		$allRole = Role::all();
		return view('user-manage.create', compact('title', 'allRole'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// dd($request->all());

		$message = [
			'name.required' => 'The first name field required.',
			'role_ids.required' => 'The role field required.',
		];

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'user_name' => 'required',
			'email' => 'required',
			'phone_no' => 'required',
			'role_ids' => 'required',
			'password' => 'required|confirmed|min:6',
		], $message);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		try {

			$allRequest = $request->except(['role_ids', 'password']);
			$data = [
				'name' => $request->name,
				'user_name' => $request->user_name,
				'email' => $request->email,
				'phone_no' => $request->phone_no,
				'address' => $request->address,
				'profile_image' => $request->profile_image,
				'password' => Hash::make($request->password),
				'created_by' => Auth::guard('admin')->user()->id,
				'is_admin' => 0,
			];
			
			if (in_array(4, $request->role_ids)) {
				$data['is_admin'] = 1;
			}
			
			$user = User::create($data);
			$user->roles()->attach($request->role_ids);
			// User::create($allRequest +['created_by'=>Auth::guard('admin')->user()->id,'password'=>hash::make($request->password)]);
			//$user = User::create($request->all()+['created_by'=>Auth::guard('admin')->user()->id,'password'=>$password]);
			//$user = User::create($request->only(['f_name', 'l_name', 'email']) + ['password' => bcrypt('user123')]);
			// $user->roles()->attach($request->role_ids);

			Session::flash('msg', 'Sucessfuly created');
			return redirect()->route('admin.user-manage.index');
		} catch (\Exception $e) {
			Session::flash('error', $e->getMessage());
			return redirect()->back();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$title = 'User Edit';
		$user = User::find($id);
		// $isEmployer = $user->isEmployer();
		return view('user-manage.edit', compact('title', 'user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$message = [
			'f_name.required' => 'The first name field required.',
			'l_name.required' => 'The last name field required.',
		];

		$validator = Validator::make($request->all(), [
			'f_name' => 'required',
			'l_name' => 'required',
			'user_name' => 'required',
			'email' => 'required',
			'mobile' => 'required',
		], $message);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		try {
			$user = User::find($id);
			$user->fill($request->all());
			$user->save();
			Session::flash('msg', 'Sucessfuly updated');
			return redirect()->route('admin.user-manage.index');
		} catch (\Exception $e) {
			Session::flash('error', $e->getMessage());
			return redirect()->back();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		try {
			$user = User::find($id);
			$user->delete();
			return response()->json(['status' => 200, 'status_text' => 'Successfuly deleted']);
		} catch (\Exception $e) {
			return response()->json(['status' => 500, 'status_text' => $e->getMessage()]);
		}
	}
}
