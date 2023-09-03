<?php

namespace App\Http\Controllers\centre;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Validator;
class CentreCourseController extends Controller
{
    public function fetchCourseDetailsCentre() {
		$title = 'Create Course';
		return view('centre.course.course', compact('title'));
	}
    public function addCourse(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'course_name'=> 'required',
                'academic_session_id'=> 'required',
                'fees'=> 'required',
                'fees_adv'=> 'required',
                'status'=> 'required',

            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            }

            else {
                $course = new Course();
                $course->name = $request->course_name;
                $course->academic_session_id =$request->academic_session_id;
                $course->fees = $request->fees;
                $course->fees_adv = $request->fees_adv;
                $course->status = $request->status;
                $course->save();
                return response()->json([
                    'status'=>true,
                    'message'=>'Course  added successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }
    public function fetchCourse(Request $request){
        try {
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowPerPage = $request->get("length");
            $orderArray = $request->get('order');
            $columnNameArray = $request->get('columns');
            $searchArray = $request->get('search');
            $columnIndex = $orderArray[0]['column'];
            $columnName = $columnNameArray[$columnIndex]['data'];
            $columnSortOrder = $orderArray[0]['dir'];
            $searchValue = $searchArray['value'];

            $users = Course::query();
            $total = $users->count();

            $totalFilter = Course::query();
            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('name','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $arrData = Course::query();
            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('name','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();

            $course_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_no = $start + $i++;
                    $course_name = $record->name;
                    $academic_session_id = $record->academic_session_id;
                    $fees = $record->fees;
                    $fees_adv = $record->fees_adv;
                    $status = $record->status;

                    $action = '<div class="text-center"><a href="javascript:void(0)" id="Edit-Course-Btn" data-e_id="'.$record->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" id="delete-Course-Btn" data-d_id="'.$record->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    ';

                    $course_arr[] = array(
                        "id" => $sl_no,
                        "name" => $course_name,
                        "academic_session_id" => $academic_session_id,
                        "fees" => $fees,
                        "fees_adv" => $fees_adv,
                        "status" => $status,
                        "action" => $action,

                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $course_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }
    public function editCourse(Request $request){
        try {
            $course = Course::find($request->edit_id);
            if($course)
            {
                return response()->json([
                    'status'=>true,
                    'course_details'=> $course,
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'No Details Found'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }
    public function updateCourse(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'edit_course_name'=> 'required',
                'edit_academic_session_id'=> 'required',
                'edit_fees'=> 'required',
                'edit_fees_adv'=> 'required',
                'edit_status'=> 'required',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()
                ]);
            }
            else
            {
                $course = Course::find($request->update_id);
                if($course)
                {
                    if($course->name ==  $request->edit_course_name &&
                    $course->academic_session_id == $request->edit_academic_session_id &&
                    $course->fees ==  $request->edit_fees &&
                    $course->fees_adv ==  $request->edit_fees_adv &&
                    $course->status ==  $request->edit_status
                    ) {
                        return response()->json([
                            'status'=>false,
                            'message'=>'Nothing to change'
                        ]);
                    } else {
                        $course->name = $request->edit_course_name;
                        $course->academic_session_id=$request->edit_academic_session_id ;
                        $course->fees = $request->edit_fees;
                        $course->status =  $request->edit_status ;
                        $course->fees_adv =  $request->edit_fees_adv;
                        $course->save();
                        return response()->json([
                            'status'=>true,
                            'message'=>'Course Updated successfully'
                        ]);
                    }
                }
                else
                {
                    return response()->json([
                        'status'=>false,
                        'message'=>'No Details Found.'
                    ]);
                }

            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }

    }
    public function deleteCourse(Request $request){
        try {
            $del_course_data = Course::find($request->id);
            if($del_course_data)
            {
                $del_course_data->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Course Deleted Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'No Details Found.'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }
}
