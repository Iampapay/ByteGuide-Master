<?php

namespace App\Http\Controllers\centre;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchStudentRelationTbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Auth;

class CentreBatchController extends Controller
{

    public function fetchBatchDetailsCentre() {
		$title = 'Create Batch';
		return view('centre.batch.batch', compact('title'));
	}

    public function addBatch(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'batch_name'=> 'required',
                'batch_code'=> 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            }

            else {
                $batch = new Batch();
                $batch->created_by = Auth::guard('centre')->user()->id;
                $batch->batch_name = $request->batch_name;
                $batch->batch_code = $request->batch_code;
                $batch->status = 0;
                $batch->save();
                return response()->json([
                    'status'=>true,
                    'message'=>'Batch  added successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function fetchBatch(Request $request){
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

            $users = Batch::where('created_by', Auth::guard('centre')->user()->id)->get();
            $total = $users->count();

            $totalFilter = Batch::where('created_by', Auth::guard('centre')->user()->id)->get();
            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('batch_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('batch_code','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('status','like','%'.$searchValue.'%');
            }
            $totalFilter = $totalFilter->count();

            $arrData = Batch::where('created_by', Auth::guard('centre')->user()->id);
            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('batch_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('batch_code','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('status','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();
            $appUrl = config('app.url');
            $batch_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $sl_no = $start + $i++;
                    $batch_name = $record->batch_name;
                    $batch_code = $record->batch_code;
                    $studentCount = BatchStudentRelationTbl::where('batch_id', $record->id)->count();
                    if ($record->status == 0) {
                        $status = '<span class="badge-pill badge-secondary">Not Approved</span>';
                        $disabled = '';
                    } else if ($record->status == 1) {
                        $status = '<span class="badge-pill badge-success">Approved</span>';
                        $disabled = 'pointer-events: none';
                    } else if ($record->status == 2) {
                        $status = '<span class="badge-pill badge-primary">Pending</span>';
                        $disabled = 'pointer-events: none';
                    } else {
                        $status = '<span class="badge-pill badge-danger">Rejected</span>';
                        $disabled = 'pointer-events: none';
                    }
                    $action = '<div class="text-center"><a href="javascript:void(0)" id="Edit-Batch-Btn" data-e_id="'.$record->id.'" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" id="delete-Batch-Btn" data-d_id="'.$record->id.'" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp<a href="'.$appUrl.'/cineteq/centre/show-student-list/'.base64_encode($record->id).'" id="viewStudList" data-b_id="'.$record->id.'" title="Assign Student"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" id="send-app-reqBtn" data-b_id="'.$record->id.'" title="Sent Approval Request" style="'.$disabled.'"><i class="fa fa-share-square-o" aria-hidden="true"></i></a>';

                    $batch_arr[] = array(
                        "id" => $sl_no,
                        "batch_name" => $batch_name,
                        "batch_code" => $batch_code,
                        "ass_student" => $studentCount,
                        "status" => $status,
                        "action" => $action,

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

    public function editBatch(Request $request){
        try {
            $batch = Batch::find($request->edit_id);
            if($batch)
            {
                return response()->json([
                    'status'=>true,
                    'batch_details'=> $batch,
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

    public function updateBatch(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'edit_batch_name'=> 'required',
                'edit_batch_code'=> 'required',
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
                $batch = Batch::find($request->update_id);
                if($batch)
                {
                    if($batch->batch_name ==  $request->edit_batch_name &&
                    $batch->batch_code == $request->edit_batch_code) {
                        return response()->json([
                            'status'=>false,
                            'message'=>'Nothing to change'
                        ]);
                    } else {
                        $batch->batch_name = $request->edit_batch_name;
                        $batch->batch_code =$request->edit_batch_code;
                        $batch->save();
                        return response()->json([
                            'status'=>true,
                            'message'=>'Batch  Updated successfully'
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

    public function deleteBatch(Request $request){
        try {
            $del_batch_data = Batch::find($request->id);
            if($del_batch_data)
            {
                $assign_stud_from_batch = BatchStudentRelationTbl::where('batch_id', $request->id)->get();
                if(!$assign_stud_from_batch->isEmpty()) {
                    $del_assign_stud_from_batch = BatchStudentRelationTbl::where('batch_id', $request->id)->delete();
                }
                $del_batch_data->delete();
                return response()->json([
                    'status'=>true,
                    'message'=>'Batch Details Deleted Successfully.'
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

    public function studentList($id){
        try {
            $title = 'Student List';
            $batch_details = Batch::find(base64_decode($id));
            $notFound = 'No Details Found';
            if($batch_details)
            {
                return view('centre.student.list', compact('title', 'batch_details'));
            }
            else
            {
                return view('centre.student.list', compact('title', 'notFound'));
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function assignBatch(Request $request){
        try {
            foreach ($request->stud_data as $sData) {
                $if_exist = BatchStudentRelationTbl::where('batch_id', $request->batch_id)
                                                    ->where('student_id', $sData['studID'])
                                                    ->get();
                if ($if_exist->isEmpty()) {
                    $assBatch = new BatchStudentRelationTbl;
                    $assBatch->batch_id = $request->batch_id;
                    $assBatch->student_id = $sData['studID'];
                    $assBatch->save();
                } else {
                    $upAssBatch = BatchStudentRelationTbl::find($if_exist->first()->id);
                    if($upAssBatch) {
                        $upAssBatch->batch_id = $request->batch_id;
                        $upAssBatch->student_id = $sData['studID'];
                        $upAssBatch->update();
                    } else {
                        return response()->json([
                            'status'=>400,
                            'message'=>'Batch not found.'
                        ]);
                    }
                }
            }
            return response()->json([
                'status'=>200,
                'message'=>'Batch assigned successfully.'
            ]);
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function approveBatch(Request $request){
        try {
            $batchApp = Batch::find($request->batc_id);
            if ($batchApp) {
                $batchApp->status = 2;
                $batchApp->update();
                return response()->json([
                    'status'=>true,
                    'message'=>'Approval Request Sent'
                ]);
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

}

