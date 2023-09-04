<?php

namespace App\Http\Controllers\Centre;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PlacementDetails;
use App\Models\StudentBasicDetails;
use App\Models\StudentFeedbackDetails;
use App\Models\StudentContactDetails;
use App\Models\Role;
use App\Models\Batch;
use App\Models\BatchStudentRelationTbl;
use App\Models\RegisterEmployeer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;
use Session;
use Auth;
use Exception;

class CentrePlacementController extends Controller {

    /* function for return the placement view page from controller */
	public function viewPlacement() {
		$title = 'Create Placement';
		return view('centre.placement.placement', compact('title'));
	}

    /* function for retrive all placement details from database to show in a datatable */
    public function fetchPlacementDetails(Request $request){
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
                    $action = '<div class="text-center">
                    <a href="'.$appUrl.'/cineteq/centre/show-placement-details/'.base64_encode($record->id).'" id="applyPlaceBtn" data-j_id="'.$record->id.'">Apply <i class="fa fa-hand-o-right" aria-hidden="true"></i></a></div>';

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

    /* function for find a particular placement details from database */
    public function showPlacementDetails($id){
        try {
            $title = 'View Placement';
            $placement_details = PlacementDetails::find(base64_decode($id));
            $emplr_details = RegisterEmployeer::find($placement_details->employeer_id);
            $batch_details = Batch::Where('created_by', Auth::guard('centre')->user()->id)->get();
            $notFound = 'No Details Found';
            if($placement_details)
            {
                return view('centre.placement.placementDetails', compact('title', 'placement_details', 'emplr_details', 'batch_details'));
            }
            else
            {
                return view('centre.placement.placementDetails', compact('title', 'notFound'));
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for retrive student details from database to send whatsapp message */
    public function fetchStudentToAssignBatch(Request $request) {
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
                case 'select':
                    $orderTable = 'student_basic_details.';
                    $columnName = 'id';
                    break;

                case 's_name':
                    $orderTable = 'student_basic_details.';
                    $columnName = 's_f_name';
                    break;

                case 'email':
                    $orderTable = 'student_contact_details.';
                    $columnName = 'email_id';
                    break;

                case 'phone':
                    $orderTable = 'student_contact_details.';
                    $columnName = 'pri_mbl_no';
                    break;

                default:
                    $orderTable = '';
            }

            $students_already_ass_to_batch = BatchStudentRelationTbl::pluck('student_id')->toArray();

            $Stud = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                ->where('student_basic_details.created_by', Auth::guard('centre')->user()->id)
                                ->whereNotIn('student_basic_details.id', $students_already_ass_to_batch)
                                ->get();

            $total = $Stud->count();

            $totalFilter = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                ->where('student_basic_details.created_by', Auth::guard('centre')->user()->id)
                                ->whereNotIn('student_basic_details.id', $students_already_ass_to_batch);

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter ->get()->count();

            $arrData = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                ->where('student_basic_details.created_by', Auth::guard('centre')->user()->id)
                                ->whereNotIn('student_basic_details.id', $students_already_ass_to_batch);

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($orderTable.$columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();

            $student_arr = array();
                foreach ($arrData as $record) {
                    $sl_val = '<input class="form-check-input selectStud" type="checkbox" value="'.$record->id.'" id="flexCheck">';
                    $name = $record->s_f_name .' '. $record->s_m_name .' '. $record->s_l_name;
                    $email = $record->email_id;
                    $phoneNum = $record->pri_mbl_no;

                    $student_arr[] = array(
                        "select" => $sl_val,
                        "s_name" => $name,
                        "email" => $email,
                        "phone" => $phoneNum
                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $student_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function fetchStudentUnderBatch(Request $request) {
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
                case 'select':
                    $orderTable = 'student_basic_details.';
                    $columnName = 'id';
                    break;

                case 's_name':
                    $orderTable = 'student_basic_details.';
                    $columnName = 's_f_name';
                    break;

                case 'email':
                    $orderTable = 'student_contact_details.';
                    $columnName = 'email_id';
                    break;

                case 'phone':
                    $orderTable = 'student_contact_details.';
                    $columnName = 'pri_mbl_no';
                    break;

                default:
                    $orderTable = '';
            }

            $Stud = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                        ->join('batch_student_relation_tbls', 'student_basic_details.id', '=', 'batch_student_relation_tbls.student_id')
                                        ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                        ->where('student_basic_details.created_by', Auth::guard('centre')->user()->id)
                                        ->where('batch_student_relation_tbls.batch_id', $request->batch_id)
                                        ->get();

            $total = $Stud->count();

            $totalFilter = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                                ->join('batch_student_relation_tbls', 'student_basic_details.id', '=', 'batch_student_relation_tbls.student_id')
                                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                                ->where('student_basic_details.created_by', Auth::guard('centre')->user()->id)
                                                ->where('batch_student_relation_tbls.batch_id', $request->batch_id);

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter ->get()->count();

            $arrData = StudentBasicDetails::select('student_basic_details.id', 's_f_name', 's_m_name', 's_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                            ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                            ->join('batch_student_relation_tbls', 'student_basic_details.id', '=', 'batch_student_relation_tbls.student_id')
                                            ->where('student_basic_details.created_by', Auth::guard('centre')->user()->id)
                                            ->where('batch_student_relation_tbls.batch_id', $request->batch_id);

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($orderTable.$columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();

            $student_arr = array();
                foreach ($arrData as $record) {
                    $sl_val = '<input class="form-check-input selectStud" type="checkbox" value="'.$record->id.'" id="flexCheck">';
                    $name = $record->s_f_name .' '. $record->s_m_name .' '. $record->s_l_name;
                    $email = $record->email_id;
                    $phoneNum = $record->pri_mbl_no;

                    $student_arr[] = array(
                        "select" => $sl_val,
                        "s_name" => $name,
                        "email" => $email,
                        "phone" => $phoneNum
                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $student_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for send message of placement opportunity to each student's registered mobile number */
    public function sendMessage(Request $request) {
        try {
            $msg = $request->msg;
            $encryptedJobId = Crypt::encryptString($request->job_id);
            $generate_job_link = $request->base_url.'/student-feedback-form/'.$encryptedJobId.'';
            $studData = $request->stud_data;
            $templateBody = "{$msg} {$generate_job_link}";

            foreach ($request->stud_data as $sData) {
                $studID = $sData['studID'];
                $studPH = StudentContactDetails::select('pri_mbl_no')->where('stud_unq_id', $studID)->get();
                foreach ($studPH as $contactDetails) {
                    $priMblNo = $contactDetails->pri_mbl_no;

                    $curl = curl_init();

                    $data = [
                        "messaging_product" => "whatsapp",
                        "to" => '91'.$priMblNo,
                        "type" => "template",
                        "template" => [
                            "namespace" => "1bb0ff74_c45d_4b3a_bace_5d5015515950",
                            "name" => "job_update",
                            "language" => [
                                "code" => "en_US"
                            ],
                            "components" => [
                                [
                                    "type" => "body",
                                    "parameters" => [
                                        [
                                            "type" => "text",
                                            "text" => $templateBody
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ];

                    $data_json = json_encode($data);

                    $headers = [
                        "Authorization: Bearer EAAKvpnQ7ehb6diKh2gwxlTwBp5gjDoPpVZAUH7dpbE3KNvyCfQZDZD",
                        "Content-Type: application/json"
                    ];

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://graph.facebook.com/v17.0/109370888929451/messages",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => $data_json,
                        CURLOPT_HTTPHEADER => $headers,
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    if ($err) {
                        $responses[] = [
                            'status' => false,
                            'response' => $err
                        ];
                    } else {
                        $responses[] = [
                            'status' => true,
                            'response' => $response
                        ];
                    }
                }
            }
            curl_close($curl);
            return response()->json($responses);
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for view student placement feedback form of a particular placement details */
    public function studentFeedback($id) {
        try {
            $decryptedJobId = Crypt::decryptString($id);
            $job_details = PlacementDetails::find($decryptedJobId);
            $employeer_details = RegisterEmployeer::find($job_details->employeer_id);
            return view('centre.studentFeedback.studentFeedback', compact('job_details', 'employeer_details'));
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    /* function for insert student placement feedback form data */
    public function submitPlacementFeedback(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'phone'=> 'required',
                'email'=> 'required',
                'interest'=> 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            }

            else {
                $if_exist = StudentFeedbackDetails::select('id')
                    ->where('job_id', $request->jid)
                    ->where('phone', $request->phone)
                    ->get()
                    ->count();
                $if_exist2 = StudentFeedbackDetails::select('id')
                    ->where('job_id', $request->jid)
                    ->where('email', $request->email)
                    ->get()
                    ->count();
                if ($if_exist > 0 || $if_exist2 > 0) {
                    return response()->json([
                        'status'=>400,
                        'message'=>'Your Response has already been submitted'
                    ]);
                } else {
                    $addFeed = new StudentFeedbackDetails;
                    $addFeed->job_id = $request->jid;
                    $addFeed->phone = $request->phone;
                    $addFeed->email = $request->email;
                    $addFeed->is_interested = $request->interest;
                    $addFeed->save();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Your Response has been submitted sucessfully'
                    ]);
                }
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

}
