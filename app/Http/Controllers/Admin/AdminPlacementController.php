<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PlacementDetails;
use App\Models\StudentBasicDetails;
use App\Models\StudentFeedbackDetails;
use App\Models\StudentContactDetails;
use App\Models\RegisterEmployeer;
use App\Models\Role;
use App\Models\Batch;
use App\Models\BatchStudentRelationTbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;
use Exception;

class AdminPlacementController extends Controller {

    /* function for view employeer details page */
    public function viewEmployeer() {
        $title = 'Register Employeer';
		return view('admin.placement.employeer', compact('title'));
    }

    /* function for insert employeer details */
    public function addEmployeer(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'comp_name'=> 'required',
                'comp_address'=> 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            }

            else {
                $employeer = new RegisterEmployeer;
                $employeer->comp_name = $request->comp_name;
                $employeer->comp_address = $request->comp_address;
                if ($request->comp_logo != '') {
                    $comLogoName = 'logo_' . time(). '.' .$request->comp_logo->getClientOriginalExtension();
                    $directory = 'company-Logo';
                    if (!Storage::exists($directory)) {
                        Storage::makeDirectory($directory);
                    }
                    $request->comp_logo->move(public_path($directory), $comLogoName);
                    $employeer->comp_logo = $comLogoName;
                } else {
                    $employeer->comp_logo = 'null';
                }
                $employeer->save();
                return response()->json([
                    'status'=>true,
                    'message'=>'Employer details added successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for edit employeer details */
    public function editEmployeer(Request $request){
        try {
            $employeer = RegisterEmployeer::find($request->edit_id);
            if($employeer)
            {
                return response()->json([
                    'status'=>true,
                    'employeer_details'=> $employeer,
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

    /* function for update employeer details */
    public function updateEmployeer(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'comp_name'=> 'required',
                'comp_address'=> 'required',
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
                $update_employeer = RegisterEmployeer::find($request->update_id);
                if($update_employeer)
                {
                    if($update_employeer->comp_name == $request->comp_name &&
                    $update_employeer->comp_address == $request->comp_address &&
                    $update_employeer->comp_logo == $request->comp_logo) {
                        return response()->json([
                            'status'=>false,
                            'message'=>'Nothing to change'
                        ]);
                    } else {
                        $update_employeer->comp_name = $request->comp_name;
                        $update_employeer->comp_address = $request->comp_address;
                        if ($request->comp_logo != '') {
                            $comLogoName = 'logo_' . time(). '.' .$request->comp_logo->getClientOriginalExtension();
                            $directory = 'company-Logo';
                            if (!Storage::exists($directory)) {
                                Storage::makeDirectory($directory);
                            }
                            $request->comp_logo->move(public_path($directory), $comLogoName);
                            $update_employeer->comp_logo = $comLogoName;
                        }
                        $update_employeer->update();
                        return response()->json([
                            'status'=>true,
                            'message'=>'Employer Details Updated Successfully.'
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

    /* function for fetch employeer details */
    public function fetchEmployeer(Request $request){
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

            $users = RegisterEmployeer::query();
            $total = $users->count();

            $totalFilter = RegisterEmployeer::query();
            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('comp_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('comp_address','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $arrData = RegisterEmployeer::query();
            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('comp_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('comp_address','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();

            $placement_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_no = $start + $i++;
                    $comp_name = $record->comp_name;
                    if (strlen($record->comp_address) > 20) {
                        $comp_address = substr($record->comp_address, 0, 20). "...";
                    } else{
                        $comp_address = $record->comp_address;
                    }
                    $comp_logo = $record->comp_logo;
                    $action = '<div class="text-center"><a href="javascript:void(0)" id="EditemployeeBtn" data-e_id="'.$record->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" id="deleteEmployeeBtn" data-d_id="'.$record->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    ';

                    $placement_arr[] = array(
                        "id" => $sl_no,
                        "comp_name" => $comp_name,
                        "comp_address" => $comp_address,
                        "comp_logo" => $comp_logo,
                        "action" => $action,

                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $placement_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for delete employeer details */
    public function deleteEmployeer(Request $request){
        try {
            $del_placement_data = RegisterEmployeer::find($request->id);
            if($del_placement_data)
            {
                $del_placement_data->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Employeer Details Deleted Successfully.'
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

    /* function for view placement page */
	public function viewPlacement() {
		$title = 'Create Placement';
        $employeer_data = RegisterEmployeer::all();
		return view('admin.placement.placement', compact('title', 'employeer_data'));
	}

    /* function for insert placement details in a database table */
    public function addPlacement(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'employeer'=> 'required',
                'title'=> 'required',
                'description'=> 'required',
                'experience'=> 'required',
                'location'=> 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            }

            else {
                $placementData = new PlacementDetails;
                $placementData->employeer_id = $request->employeer;
                $placementData->job_title = $request->title;
                $placementData->job_desc = $request->description;
                $placementData->job_exp = $request->experience;
                $placementData->job_loc = $request->location;
                $placementData->save();
                return response()->json([
                    'status'=>true,
                    'message'=>'Placement details added successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for retrive all placement details from database to show in a datatable */
    public function fetchPlacement(Request $request){
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

            $users = RegisterEmployeer::select('placement_details.*', 'register_employeers.comp_name', 'register_employeers.comp_logo')
                                ->join('placement_details', 'register_employeers.id', '=', 'placement_details.employeer_id');

            $total = $users->count();

            $totalFilter = RegisterEmployeer::select('placement_details.*', 'register_employeers.comp_name', 'register_employeers.comp_logo')
                                    ->join('placement_details', 'register_employeers.id', '=', 'placement_details.employeer_id');

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('register_employeers.comp_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orwhere('placement_details.job_title','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('placement_details.job_desc','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('placement_details.job_exp','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('placement_details.job_loc','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $arrData = RegisterEmployeer::select('placement_details.*', 'register_employeers.comp_name', 'register_employeers.comp_logo')
                                    ->join('placement_details', 'register_employeers.id', '=', 'placement_details.employeer_id');

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('register_employeers.comp_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orwhere('placement_details.job_title','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('placement_details.job_desc','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('placement_details.job_exp','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('placement_details.job_loc','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();

            $appUrl = config('app.url');
            $placement_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_no = $start + $i++;
                    $compName = $record->comp_name;
                    $compLogo = $record->comp_logo;
                    $title = $record->job_title;
                    if (strlen($record->job_desc) > 20) {
                        $description = substr($record->job_desc, 0, 20). "...";
                    } else{
                        $description = $record->job_desc;
                    }
                    $experience = $record->job_exp;
                    $location = $record->job_loc;
                    $action = '<div class="text-center"><a href="javascript:void(0)" id="editPlacementBtn" data-e_id="'.$record->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" id="deletePlacementBtn" data-d_id="'.$record->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$appUrl.'/cineteq/admin/trainee-placement/'.base64_encode($record->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';

                    $placement_arr[] = array(
                        "id" => $sl_no,
                        "comp_name" => $compName,
                        "comp_logo" => $compLogo,
                        "job_title" => $title,
                        "job_desc" => $description,
                        "job_exp" => $experience,
                        "job_loc" => $location,
                        "action" => $action
                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $placement_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for find a particular student details from database */
    public function editPlacement(Request $request){
        try {
            $placement = PlacementDetails::find($request->edit_id);
            if($placement)
            {
                return response()->json([
                    'status'=>true,
                    'placement_details'=> $placement,
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

    /* function for update student details from database */
    public function updatePlacement(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'update_employeer'=> 'required',
                'update_title'=> 'required',
                'update_description'=> 'required',
                'update_experience'=> 'required',
                'update_location'=> 'required',
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
                $update_placement = PlacementDetails::find($request->update_id);
                if($update_placement)
                {
                    if($update_placement->employeer_id == $request->update_employeer &&
                    $update_placement->job_title == $request->update_title &&
                    $update_placement->job_desc == $request->update_description &&
                    $update_placement->job_exp == $request->update_experience &&
                    $update_placement->job_loc == $request->update_location) {
                        return response()->json([
                            'status'=>false,
                            'message'=>'Nothing to change'
                        ]);
                    } else {
                        $update_placement->employeer_id = $request->update_employeer;
                        $update_placement->job_title = $request->update_title;
                        $update_placement->job_desc = $request->update_description;
                        $update_placement->job_exp = $request->update_experience;
                        $update_placement->job_loc = $request->update_location;
                        $update_placement->update();
                        return response()->json([
                            'status'=>true,
                            'message'=>'Placement Details Updated Successfully.'
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

    /* function for delete student details from database */
    public function deletePlacement(Request $request){
        try {
            $del_placement_data = PlacementDetails::find($request->id);
            if($del_placement_data)
            {
                $del_placement_data->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Placement Details Deleted Successfully.'
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

    /* function for retrive student details from database to show in a datatable */
    // public function fetchStudent(Request $request){
    //     try {
    //         $draw = $request->get('draw');
    //         $start = $request->get("start");
    //         $rowPerPage = $request->get("length");
    //         $orderArray = $request->get('order');
    //         $columnNameArray = $request->get('columns');
    //         $searchArray = $request->get('search');
    //         $columnIndex = $orderArray[0]['column'];
    //         $columnName = $columnNameArray[$columnIndex]['data'];
    //         $columnSortOrder = $orderArray[0]['dir'];
    //         $searchValue = $searchArray['value'];

    //         switch ($columnName) {
    //             case 'select':
    //             case 's_f_name':
    //                 $orderTable = 'student_basic_details.';
    //                 $columnName = 'id';
    //                 break;

    //             case 'email_id':
    //             case 'pri_mbl_no':
    //                 $orderTable = 'student_contact_details.';
    //                 $columnName = 'email_id';
    //                 break;

    //             default:
    //                 $orderTable = '';
    //         }

    //         $Stud = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
    //                             ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
    //                             ->get();

    //         $total = $Stud->count();

    //         $totalFilter = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
    //                             ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id');

    //         if (!empty($searchValue)) {
    //             $totalFilter = $totalFilter->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
    //             $totalFilter = $totalFilter->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
    //             $totalFilter = $totalFilter->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
    //             $totalFilter = $totalFilter->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
    //             $totalFilter = $totalFilter->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
    //         }
    //         $totalFilter = $totalFilter ->get()->count();

    //         $arrData = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
    //                                         ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id');
    //         $arrData = $arrData->skip($start)->take($rowPerPage);
    //         $arrData = $arrData->orderBy($orderTable.$columnName,$columnSortOrder);

    //         if (!empty($searchValue)) {
    //             $arrData = $arrData->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
    //             $arrData = $arrData->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
    //             $arrData = $arrData->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
    //             $arrData = $arrData->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
    //             $arrData = $arrData->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
    //         }

    //         $arrData = $arrData->get();

    //         $student_arr = array();
    //             foreach ($arrData as $record) {
    //                 $student_arr[] = array(
    //                     "select" => '<input class="form-check-input selectStud" type="checkbox" value="'.$record->id.'" id="flexCheck">',
    //                     "s_f_name" => $record->s_f_name .' '. $record->s_m_name .' '. $record->s_l_name,
    //                     "email_id" => $record->email_id,
    //                     "pri_mbl_no" => $record->pri_mbl_no
    //                 );
    //             }

    //         $response = array(
    //             "draw" => intval($draw),
    //             "recordsTotal" => $total,
    //             "recordsFiltered" => $totalFilter,
    //             "data" => $student_arr
    //         );

    //         return response()->json($response);

    //     } catch(Exception $e){
    //         return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
    //     }
    // }

    public function traineePlacement($id){
        $title = 'Trainee Placement';
        $placement_id = $id;
        $centre_details = User::where('is_admin', 1)
                            ->where('is_super_admin', 0)
                            ->get();
		return view('admin.placement.traineePlacement', compact('title', 'centre_details' , 'placement_id'));
    }

    public function searchBatch(Request $request){
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

            switch ($columnName) {
                case 'id':
                    $orderTable = 'batches.';
                    $columnName = 'id';
                    break;

                case 'batch_code':
                    $orderTable = 'batches.';
                    $columnName = 'batch_code';
                    break;

                case 'created_at':
                    $orderTable = 'batches.';
                    $columnName = 'created_at';
                    break;

                default:
                    $orderTable = '';
            }

            $batch = Batch::where('created_by', $request->centre_id);

            $total = $batch->count();

            $totalFilter = Batch::where('created_by', $request->centre_id);

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('batch_code','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('created_at','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter ->get()->count();

            $arrData = Batch::where('created_by', $request->centre_id);

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('batch_code','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('created_at','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();
            $appUrl = config('app.url');
            $batch_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_val = $start + $i++;
                    $batch_code = $record->batch_code;
                    $start_date = '-';
                    $ten_ass_date = '-';
                    $course_code = '-';
                    $status = '-';
                    $action = '<div class="text-center"><a href="'.$appUrl.'/cineteq/admin/batch/'.base64_encode($record->id).'?Q='.$request->placementID.'" id="viewBatchDetails"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';

                    $batch_arr[] = array(
                        "id" => $sl_val,
                        "batch_code" => $batch_code,
                        "start_date" => $start_date,
                        "ten_ass_date" => $ten_ass_date,
                        "course_code" => $course_code,
                        "status" => $status,
                        "action" => $action
                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $batch_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function viewBatch(Request $request, $id){
        $title = 'Assessed Trainee List';
        $batch_id = $id;
        $plc_ID = $request->query('Q');
        $batch_details = Batch::find(base64_decode($id));
        $centre_data = User::find($batch_details->created_by);
		return view('admin.placement.batchDetails', compact('title', 'plc_ID', 'batch_id', 'batch_details', 'centre_data'));
    }

    public function assessedTraineeList(Request $request){
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

            switch ($columnName) {
                case 'id':
                    $orderTable = 'student_basic_details.';
                    $columnName = 'id';
                    break;

                case 's_f_name':
                    $orderTable = 'student_basic_details.';
                    $columnName = 's_f_name';
                    break;

                case 'pri_mbl_no':
                    $orderTable = 'student_basic_details.';
                    $columnName = 'pri_mbl_no';
                    break;

                case 'dob':
                    $orderTable = 'student_basic_details.';
                    $columnName = 'dob';
                    break;

                default:
                    $orderTable = '';
            }

            $assessedTrainee = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.dob', 'student_contact_details.pri_mbl_no')
                                        ->join('batch_student_relation_tbls', 'student_basic_details.id', '=', 'batch_student_relation_tbls.student_id')
                                        ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                        ->where('batch_student_relation_tbls.batch_id', base64_decode($request->batch_id));

            $total = $assessedTrainee->count();

            $totalFilter = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.dob', 'student_contact_details.pri_mbl_no')
                                        ->join('batch_student_relation_tbls', 'student_basic_details.id', '=', 'batch_student_relation_tbls.student_id')
                                        ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                        ->where('batch_student_relation_tbls.batch_id', base64_decode($request->batch_id));


            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.dob','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }

            $totalFilter = $totalFilter ->get()->count();

            $arrData = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.dob', 'student_contact_details.pri_mbl_no')
            ->join('batch_student_relation_tbls', 'student_basic_details.id', '=', 'batch_student_relation_tbls.student_id')
            ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
            ->where('batch_student_relation_tbls.batch_id', base64_decode($request->batch_id));

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($orderTable.$columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.dob','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();
            $appUrl = config('app.url');
            $assessed_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_val = $start + $i++;
                    $trainee_name = $record->s_f_name . ' ' . $record->s_m_name . ' ' . $record->s_l_name;
                    $trainee_code = '-';
                    $mob_no = $record->pri_mbl_no;
                    $dob = date("d/m/Y", strtotime($record->dob));
                    $status = '-';
                    $action = '<div class="text-center"><a class="btn btn-sm btn-primary" href="'.$appUrl.'/cineteq/admin/trainee-placement-details/'.base64_encode($record->id).'?P='.$request->place_id.'"><i class="fa fa-eye" aria-hidden="true"></i> view</a> <a class="btn btn-sm btn-success" href="javascript:void(0)"><i class="fa fa-upload" aria-hidden="true"></i> Employment Document</a></div>';

                    $assessed_arr[] = array(
                        "id" => $sl_val,
                        "s_f_name" => $trainee_name,
                        "trainee_code" => $trainee_code,
                        "pri_mbl_no" => $mob_no,
                        "dob" => $dob,
                        "status" => $status,
                        "action" => $action
                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $assessed_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function traineePlacementDetails(Request $request, $id){
        $title = 'Trainee Placement Details';
        $plcem_details = PlacementDetails::find(base64_decode($request->query('P')));
        $employer_details = RegisterEmployeer::find($plcem_details->employeer_id);
        $student_details = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.created_by', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.dob', 'student_contact_details.pri_mbl_no')
        ->join('batch_student_relation_tbls', 'student_basic_details.id', '=', 'batch_student_relation_tbls.student_id')
        ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
        ->where('student_basic_details.id', base64_decode($id))
        ->first();
        $centre_details = User::find($student_details->created_by);
        $batc_id = BatchStudentRelationTbl::select('batch_id')->where('student_id', $student_details->id)->first();
        $batch_dtls = Batch::find($batc_id);
		return view('admin.placement.traineePlacementDetails', compact('title', 'plcem_details', 'employer_details', 'student_details', 'centre_details', 'batch_dtls'));
    }

    public function viewInterestedStudent(){
        $title = 'Interested Student';
        $placeData = PlacementDetails::all();
        return view('admin.placement.interestedStudents', compact('title', 'placeData'));
    }

    public function fetchInterestedStudent(Request $request){
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

            switch ($columnName) {
                case 'id':
                case 'job_title':
                case 'job_loc':
                    $orderTable = 'placement_details.';
                    break;

                case 'email':
                case 'phone':
                    $orderTable = 'student_feedback_details.';
                    break;

                default:
                    $orderTable = '';
            }

            $interesed_stud = PlacementDetails::select('placement_details.id', 'placement_details.job_title', 'placement_details.job_loc', 'student_feedback_details.email', 'student_feedback_details.phone')
                                ->join('student_feedback_details', 'placement_details.id', '=', 'student_feedback_details.job_id')
                                ->where('student_feedback_details.job_id', $request->place_id)
                                ->where('student_feedback_details.is_interested', 1)
                                ->get();

            $total = $interesed_stud->count();

            $totalFilter = PlacementDetails::select('placement_details.id', 'placement_details.job_title', 'placement_details.job_loc', 'student_feedback_details.email', 'student_feedback_details.phone')
                                ->join('student_feedback_details', 'placement_details.id', '=', 'student_feedback_details.job_id')
                                ->where('student_feedback_details.job_id', $request->place_id)
                                ->where('student_feedback_details.is_interested', 1);

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('placement_details.job_title','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('placement_details.job_loc','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_feedback_details.email','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_feedback_details.phone','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter ->get()->count();

            $arrData = PlacementDetails::select('placement_details.id', 'placement_details.job_title', 'placement_details.job_loc', 'student_feedback_details.email', 'student_feedback_details.phone')
                                ->join('student_feedback_details', 'placement_details.id', '=', 'student_feedback_details.job_id')
                                ->where('student_feedback_details.job_id', $request->place_id)
                                ->where('student_feedback_details.is_interested', 1);

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($orderTable.$columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('placement_details.job_title','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('placement_details.job_loc','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_feedback_details.email','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_feedback_details.phone','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();

            $inter_student_arr = array();
            $i = 1;
            foreach ($arrData as $record) {
                $inter_student_arr[] = array(
                    "id" => $start + $i++,
                    "job_title" => $record->job_title,
                    "job_loc" => $record->job_loc,
                    "email" => $record->email,
                    "phone" => $record->phone,
                );
            }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $inter_student_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }
}
