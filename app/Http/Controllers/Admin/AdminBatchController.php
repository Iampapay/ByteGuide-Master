<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BatchSlot;
use App\Models\Role;
use App\Models\Batch;
use App\Models\BatchStudentRelationTbl;
use App\Models\CentreDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Session;
use Auth;
use Carbon\Carbon;

class AdminBatchController extends Controller {

    public function batchApproval(Request $request){
        $title="Batch Approval";
        $centre_details = User::where('is_admin', 1)
                ->where('is_super_admin', 0)
                ->get();
        $centre_dist = CentreDetails::select('dist')->get();
        return view('admin.batch.batchApproval')->with(compact('title','centre_details','centre_dist'));
    }

    public function searchBatchDetails(Request $request){
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

            $batch_details = Batch::select('batches.*','users.name')
                        ->leftJoin('users', 'batches.created_by', '=', 'users.id')
                        ->leftJoin('centre_details', 'batches.created_by', '=', 'centre_details.centre_id')
                        ->where('batches.status', '!=', 0)
                        ->when($request->sector, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->sector);
                        })
                        ->when($request->course, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->course);
                        })->when($request->district, function ($query) use ($request) {
                            return $query->where('centre_details.dist', $request->district);
                        })->when($request->training_partner, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->training_partner);
                        })->when($request->training_centre, function ($query) use ($request) {
                            return $query->where('batches.created_by', $request->training_centre);
                        })->when($request->batch_type, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->batch_type);
                        })->when($request->batch_status, function ($query) use ($request) {
                            return $query->where('batches.status', $request->batch_status);
                        });

            $total = $batch_details->count();

            $totalFilter = Batch::select('batches.*','users.name')
                        ->leftJoin('users', 'batches.created_by', '=', 'users.id')
                        ->leftJoin('centre_details', 'batches.created_by', '=', 'centre_details.centre_id')
                        ->where('batches.status', '!=', 0)
                        ->when($request->sector, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->sector);
                        })
                        ->when($request->course, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->course);
                        })->when($request->district, function ($query) use ($request) {
                            return $query->where('centre_details.dist', $request->district);
                        })->when($request->training_partner, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->training_partner);
                        })->when($request->training_centre, function ($query) use ($request) {
                            return $query->where('batches.created_by', $request->training_centre);
                        })->when($request->batch_type, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->batch_type);
                        })->when($request->batch_status, function ($query) use ($request) {
                            return $query->where('batches.status', $request->batch_status);
                        })
                        ->get();

            $totalFilter = $totalFilter->count();

            $arrData = Batch::select('batches.*','users.name')
                        ->leftJoin('users', 'batches.created_by', '=', 'users.id')
                        ->leftJoin('centre_details', 'batches.created_by', '=', 'centre_details.centre_id')
                        ->where('batches.status', '!=', 0)
                        ->when($request->sector, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->sector);
                        })
                        ->when($request->course, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->course);
                        })->when($request->district, function ($query) use ($request) {
                            return $query->where('centre_details.dist', $request->district);
                        })->when($request->training_partner, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->training_partner);
                        })->when($request->training_centre, function ($query) use ($request) {
                            return $query->where('batches.created_by', $request->training_centre);
                        })->when($request->batch_type, function ($query) use ($request) {
                            return $query->where('batches.batch_name', $request->batch_type);
                        })->when($request->batch_status, function ($query) use ($request) {
                            return $query->where('batches.status', $request->batch_status);
                        });

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);

            $arrData = $arrData->get();
            $appUrl = config('app.url');
            $batch_array = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_no = $start + $i++;
                    if ($record->status == 0) {
                        $status = '<span class="badge-pill badge-secondary">Not Approved</span><br><br>
                                <span class="badge-pill badge-secondary">DSRI</span>';
                        $appDisplay = ' ';
                        $rejDisplay = ' ';
                    } else if ($record->status == 1) {
                        $status = '<span class="badge-pill badge-success">Approved</span><br><br>
                                <span class="badge-pill badge-secondary">DSRI</span>';
                        $appDisplay = 'displayNone';
                        $rejDisplay = ' ';
                    } else if ($record->status == 2) {
                        $status = '<span class="badge-pill badge-primary">Pending</span><br><br>
                                <span class="badge-pill badge-secondary">DSRI</span>';
                        $appDisplay = ' ';
                        $rejDisplay = ' ';
                    } else {
                        $status = '<span class="badge-pill badge-danger">Rejected</span><br><br>
                                <span class="badge-pill badge-secondary">DSRI</span>';
                        $appDisplay = ' ';
                        $rejDisplay = 'displayNone';
                    }
                    $centre_details = '<span class="text"><b>Centre Name: </b>'.$record->name.'</span>
                                        <span class="text"><b>Centre Code: </b></span>
                                        <span class="text"><b>Tp Name: </b>CINETEQ SERVICES PVT LTD</span>
                                        <span class="text"><b>Tp Code: </b>PBSSD/TP/2022/PUR/4853</span>';
                    $batch_details = '<span class="text"><b>Batch Code: '.$record->batch_code.'</b></span>
                                        <span class="text"><b><i class="fa fa-calendar" aria-hidden="true"></i> Start Date: </b></span>
                                        <span class="text"><b><i class="fa fa-calendar" aria-hidden="true"></i> End Date: </b></span>
                                        <span class="text"><b>Batch Type: </b></span>
                                        <span class="text"><b>Tentative Assessment date: </b></span>
                                        <span class="text"><b>Start Date: </b></span>';
                    $status = $status;
                    $action = ' <div class="approve '.$appDisplay.'">
                                    <a href="javascript:void(0)" id="approveBatchBtn" data-btc_id="'.$record->id.'"><i class="fa fa-check" aria-hidden="true"></i> Approve</a>
                                </div>
                                <div class="reject '.$rejDisplay.'">
                                    <a  href="javascript:void(0)" id="rejectBatchBtn" data-btc_id="'.$record->id.'"><i class="fa fa-times" aria-hidden="true"></i> Reject</a>
                                </div>
                                <div class="view">
                                    <a href="'.$appUrl.'/cineteq/admin/view-batch-details/'.base64_encode($record->id).'" id="viewBatchMonitoring" data-btch_ID="'.$record->id.'"><i class="fa fa-eye"></i> View</a>
                                </div>
                                <div class="download">
                                    <a href="#"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                </div>';

                    $batch_array[] = array(
                        "id" => $sl_no,
                        "centre_details" => $centre_details,
                        "batch_details" => $batch_details,
                        "status" => $status,
                        "action" => $action,

                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $batch_array
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function batchPermissionReq(Request $request){
        try {
            $batchPer = Batch::find($request->btc_id);
            if ($batchPer) {
                if ($request->btc_req == 'app') {
                    $batchPer->status = 1;
                    $batchPer->update();
                    return response()->json([
                        'status'=>true,
                        'message'=>'Requested Batch Approved'
                    ]);
                } else {
                    $batchPer->status = 3;
                    $batchPer->update();
                    return response()->json([
                        'status'=>true,
                        'message'=>'Requested Batch Rejected'
                    ]);
                }
            } else {
                return response()->json([
                    'status'=>false,
                    'message'=>'No Details Found.'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function viewBatchDetails($id){
        $title="Trainee Batch List";
        $batchData = Batch::select('batches.*','users.name')
                            ->leftJoin('users', 'batches.created_by', '=', 'users.id')
                            ->where('batches.id', base64_decode($id))
                            ->get();
        $studentCounting = BatchStudentRelationTbl::where('batch_id', base64_decode($id))->count();
        return view('admin.batch.traineeBatchDetails')->with(compact('title','batchData','studentCounting'));
    }

    public function batchMonitoringList(Request $request) {
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
                case 's_f_name':
                case 's_m_name':
                case 's_l_name':
                case 'dob':
                    $orderTable = 'student_basic_details.';
                    break;

                case 'email_id':
                case 'pri_mbl_no':
                    $orderTable = 'student_contact_details.';
                    break;

                default:
                    $orderTable = '';
            }

            $users = Batch::select('student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                ->join('batch_student_relation_tbls as relation1', 'batches.id', '=', 'relation1.batch_id')
                                ->join('student_basic_details', 'student_basic_details.id', '=', 'relation1.student_id')
                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                ->where('batches.id', base64_decode($request->btch_id))
                                ->get();


            $total = $users->count();

            $totalFilter = Batch::select('student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                    ->join('batch_student_relation_tbls as relation1', 'batches.id', '=', 'relation1.batch_id')
                                    ->join('student_basic_details', 'student_basic_details.id', '=', 'relation1.student_id')
                                    ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                    ->where('batches.id', base64_decode($request->btch_id))
                                    ->get();

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $arrData = Batch::select('student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                    ->join('batch_student_relation_tbls as relation1', 'batches.id', '=', 'relation1.batch_id')
                                    ->join('student_basic_details', 'student_basic_details.id', '=', 'relation1.student_id')
                                    ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                    ->where('batches.id', base64_decode($request->btch_id));

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

            $batch_monitoring_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $batch_monitoring_arr[] = array(
                        "id" => $start + $i++,
                        "s_f_name" => $record->s_f_name . ' ' . $record->s_m_name . ' '. $record->s_l_name,
                        "in_time" => '-',
                        "out_time" => '-',
                        "pri_mbl_no" => $record->pri_mbl_no,
                        "email_id" => $record->email_id,
                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $batch_monitoring_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

	public function viewSlot() {
		$title = 'Create Slot';
		return view('admin.batch.batchSlot', compact('title'));
	}

    public function addSlot(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'start_time'=> 'required',
                'end_time'=> 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            }

            else {
                $slot = new BatchSlot;
                $start_time = Carbon::createFromFormat('h:i A', $request->input('start_time'));
                $end_time = Carbon::createFromFormat('h:i A', $request->input('end_time'));
                $slot->start_time = $start_time->format('h:i A');
                $slot->end_time = $end_time->format('h:i A');
                $slot->save();
                return response()->json([
                    'status'=>true,
                    'message'=>'Batch slot added successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function fetchBatchSlot(Request $request){
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

            $users = BatchSlot::query();
            $total = $users->count();

            $totalFilter = BatchSlot::query();
            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('start_time','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('end_time','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $arrData = BatchSlot::query();
            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('start_time','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('end_time','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();

            $batch_slot_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_no = $start + $i++;
                    $start_time = $record->start_time;
                    $end_time = $record->end_time;
                    $action = '<div class="text-center"><a href="javascript:void(0)" id="Edit-Batch-Slot-Btn" data-e_id="'.$record->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" id="delete-Batch-Slot-Btn" data-d_id="'.$record->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    ';

                    $batch_slot_arr[] = array(
                        "id" => $sl_no,
                        "start_time" => $start_time,
                        "end_time" => $end_time,
                        "action" => $action,

                    );
                }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $batch_slot_arr
            );

            return response()->json($response);

        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function editBatchSlot(Request $request){
        try {
            $batchslot = BatchSlot::find($request->edit_id);
            if($batchslot)
            {
                return response()->json([
                    'status'=>true,
                    'batchslot_details'=> $batchslot,
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

    public function updateBatchSlot(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'update_start_time'=> 'required',
                'update_end_time'=> 'required',
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
                $update_batch_slot = BatchSlot::find($request->update_id);
                if($update_batch_slot)
                {
                    $start_time=date('h:i A', strtotime($request->update_start_time));
                    $end_time= date('h:i A', strtotime($request->update_end_time));
                    if($update_batch_slot->start_time ==  $start_time &&
                    $update_batch_slot->end_time == $end_time) {
                        return response()->json([
                            'status'=>false,
                            'message'=>'Nothing to change'
                        ]);
                    } else {
                        $update_batch_slot->start_time =  $start_time;
                        $update_batch_slot->end_time = $end_time;
                        $update_batch_slot->update();
                        return response()->json([
                            'status'=>true,
                            'message'=>'Batch slot Details Updated Successfully.'
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

    public function deleteBatchSlot(Request $request){
        try {
            $del_slot_data = BatchSlot::find($request->id);
            if($del_slot_data)
            {
                $del_slot_data->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Batch slot Details Deleted Successfully.'
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
