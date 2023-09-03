<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentBasicDetails;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function viewTraineeList(Request $request){
        $title = 'Admin | Candidates';
        $centre_details = User::where('is_admin', 1)
                            ->where('is_super_admin', 0)
                            ->get();
        return view('admin.student.list')->with(compact('title', 'centre_details'));
    }

    public function fetchTraineeList(Request $request){
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
                case 's_f_name':
                case 'aadhaar_no':
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

            $student = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.aadhaar_no', 'student_basic_details.dob', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                            ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                            ->where('created_by', $request->c_id);

            $total = $student->count();

            $totalFilter = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.aadhaar_no', 'student_basic_details.dob', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                                ->where('created_by', $request->c_id);

            if (!empty($searchValue)) {
                $totalFilter = $totalFilter->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.aadhaar_no','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_basic_details.dob','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
                $totalFilter = $totalFilter->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }

            $totalFilter = $totalFilter ->get()->count();

            $arrData = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.aadhaar_no', 'student_basic_details.dob', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                                ->where('created_by', $request->c_id);

            $arrData = $arrData->skip($start)->take($rowPerPage);
            $arrData = $arrData->orderBy($orderTable.$columnName,$columnSortOrder);

            if (!empty($searchValue)) {
                $arrData = $arrData->where('student_basic_details.s_f_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_m_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.s_l_name','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.aadhaar_no','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_basic_details.dob','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_contact_details.email_id','like','%'.$searchValue.'%');
                $arrData = $arrData->orWhere('student_contact_details.pri_mbl_no','like','%'.$searchValue.'%');
            }

            $arrData = $arrData->get();
            $appUrl = config('app.url');
            $student_arr = array();
                $i = 1;
                foreach ($arrData as $record) {
                    $student_arr[] = array(
                        "id" => $start + $i++,
                        "s_f_name" => $record->s_f_name . ' ' . $record->s_m_name . ' ' . $record->s_l_name,
                        "email_id" => $record->email_id ? $record->email_id : '-',
                        "pri_mbl_no" => $record->pri_mbl_no,
                        "aadhaar_no" => $record->aadhaar_no ? $record->aadhaar_no : '-',
                        "dob" => date("d/m/Y", strtotime($record->dob)),
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
}
