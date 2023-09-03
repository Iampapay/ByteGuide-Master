<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Session;
use Validator;

class CoursesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$title = 'Admin | Courses';
		$Course = Course::orderBy('id', 'asc')->paginate(10);
		return view('courses.index', compact('title', 'Course'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$title = 'Admin | Course Create';
		return view('courses.create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//dd($request->all());
		$messsages = array(
			'c_name.required' => 'The Course Name field is required.',
			'academic_session_id.required' => 'Academic Session field is required.',
			'fees.required' => 'Fees field is required.',
			'fees_adv.required' => 'Advance Fees field is required.'
		);

		$validator = Validator::make($request->all(), [
			'c_name' => 'required',
			'academic_session_id' => 'required',
			'fees' => 'required',
			'fees_adv' => 'required'
		], $messsages);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		$Course=Course::create([
					'name' =>$request->c_name,
					'academic_session_id' =>$request->academic_session_id,
					'fees' =>$request->fees,
					'fees_adv' =>$request->fees_adv
				]);
				Session::flash('msg', 'Sucessfuly created');
				return redirect()->back();
		try {
			
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
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$title = 'ADMIN | ROLE EDIT';
		$Course=Course::where('id',$id)->first();
		return view('courses.edit', compact('title','Course','id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$messsages = array(
			'c_name.required' => 'The Course Name field is required.',
			'academic_session_id.required' => 'Academic Session field is required.',
			'fees.required' => 'Fees field is required.',
			'fees_adv.required' => 'Advance Fees field is required.'

		);

		$validator = Validator::make($request->all(), [
			'c_name' => 'required',
			'academic_session_id' => 'required',
			'fees' => 'required',
			'fees_adv' => 'required'
		], $messsages);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		$Course=Course::where('id',$id)->update([
			'name' =>$request->c_name,
			'academic_session_id' =>$request->academic_session_id,
			'fees' =>$request->fees,
			'fees_adv' =>$request->fees_adv
		]);
		Session::flash('msg', 'Sucessfuly Updated');
		return redirect()->back();

		try {
			
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
	public function destroy($id) {
		try {
			$Course = Course::find($id);
			$Course->delete();
			return response()->json(['status' => 200, 'status_text' => 'Sucessfuly deleted']);
		} catch (\Exception $e) {
			return response()->json(['status' => 500, 'status_text' => $e->getMessage()]);
		}
	}
}
