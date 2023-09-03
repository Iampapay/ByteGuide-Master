<?php

namespace App\Http\Controllers\centre;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\District;
use App\Models\StudentBasicDetails;
use App\Models\StudentContactDetails;
use App\Models\StudentEducationDetails;
use App\Models\StudentBankDetails;
use App\Models\StudentAttachmentDetails;
use App\Models\Role;
use App\Models\State;
use App\Models\BatchSlot;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;

class CentreStudentController extends Controller {

	public function viewReg() {
		$title = 'Student Registration';
        $state = State::all();
        $batchSlot = BatchSlot::all();
        $course = Courses::all();
		return view('centre.student.registration', compact('title','state','batchSlot','course'));
	}

    public function fetch_dist(Request $request){
        $data['dist']=District::where('state_id',$request->state_id)->get(['name','id']);
        return response()->json($data);
    }

    public function fetch_block(Request $request){
        $data['block']=Block::where('district_id',$request->dist_id)->get(['name','id']);
        return response()->json($data);
    }

    public function addStudent(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'f_name'=> 'required',
                'l_name'=> 'required',
                'fF_name'=> 'required',
                'fL_name'=> 'required',
                'mF_name'=> 'required',
                'mL_name'=> 'required',
                'rW_guardian'=> 'required',
                'gender'=> 'required',
                'phy_challenged' => 'required',
                'd_o_b'=> 'required',
                'eco_status'=> 'required',
                'res_status'=> 'required',
                'kar_id'=> 'required',
                'house_no'=> 'required',
                'street_no'=> 'required',
                'vill_town'=> 'required',
                'state'=> 'required',
                'dist'=> 'required',
                'block'=> 'required',
                'gram_pan'=> 'required',
                'post_office'=> 'required',
                'police_stn'=> 'required',
                'pin_code'=> 'required',
                'pri_mobile'=> 'required',
                'pri_mobile'=> 'required',
                'edu_qualification'=> 'required',
                'edu_qlf_status'=> 'required',
                'trng_typ'=> 'required',
                'sector'=> 'required',
                'course'=> 'required',
                'ifs_code'=> 'required',
                'bank_name'=> 'required',
                'branch_name'=> 'required',
                'acc_num'=> 'required',
                'acc_hold_name'=> 'required',
                'trainee_photo'=> 'required|file|max:10',
                'signature'=> 'required|file|max:20',
                'res_proof'=> 'required|file|max:50',
                'high_qlf_proof'=> 'required|file|max:50',
                'age_proof'=> 'required|file|max:50',
                'bank_pass'=> 'required|file|max:50',
                'drv_lic'=> 'file|max:10',
                'pass_proof'=> 'file|max:20',
                'ration_proof'=> 'file|max:50',
                'aadhaar_proof'=> 'file|max:50',
                'voter_proof'=> 'file|max:50',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first(),
                ]);
            }

            else {
                $studentBasicData = new StudentBasicDetails;
                $studentBasicData->created_by = Auth::guard('centre')->user()->id;
                $studentBasicData->s_f_name = $request->f_name;
                $studentBasicData->s_m_name = $request->m_name;
                $studentBasicData->s_l_name = $request->l_name;
                $studentBasicData->f_f_name = $request->fF_name;
                $studentBasicData->f_m_name = $request->fM_name;
                $studentBasicData->f_l_name = $request->fL_name;
                $studentBasicData->m_f_name = $request->mF_name;
                $studentBasicData->m_m_name = $request->mM_name;
                $studentBasicData->m_l_name = $request->mL_name;
                $studentBasicData->g_f_name = $request->gF_name;
                $studentBasicData->g_m_name = $request->gM_name;
                $studentBasicData->g_l_name = $request->gL_name;
                $studentBasicData->relation_w_guard = $request->rW_guardian;
                $studentBasicData->gender = $request->gender;
                $studentBasicData->physically_challenged = $request->phy_challenged;
                $studentBasicData->dob = $request->d_o_b;
                $studentBasicData->caste = $request->caste;
                $studentBasicData->religion = $request->religion;
                $studentBasicData->prf_b_slot = $request->prefere_batch;
                $studentBasicData->marital_status = $request->mar_status;
                $studentBasicData->pan_num = $request->pan_num;
                $studentBasicData->voter_id = $request->voter_id;
                $studentBasicData->birth_c_no = $request->birth_c_no;
                $studentBasicData->drv_lns_no = $request->drive_l_no;
                $studentBasicData->x_admit_no = $request->x_admit;
                $studentBasicData->aadhaar_no = $request->aadhaar_no;
                $studentBasicData->passport_no = $request->pasport_no;
                $studentBasicData->ration_c_no = $request->ration_no;
                $studentBasicData->eco_status = $request->eco_status;
                $studentBasicData->resid_status = $request->res_status;
                $studentBasicData->krdsh_id = $request->kar_id;
                $studentBasicData->save();

                $studentContactData = new StudentContactDetails;
                $studentContactData->stud_unq_id = $studentBasicData->id;
                $studentContactData->house_no = $request->house_no;
                $studentContactData->road_no = $request->street_no;
                $studentContactData->vill_town = $request->vill_town;
                $studentContactData->state = $request->state;
                $studentContactData->dist = $request->dist;
                $studentContactData->blk_mu = $request->block;
                $studentContactData->gram_pan = $request->gram_pan;
                $studentContactData->post = $request->post_office;
                $studentContactData->police_st = $request->police_stn;
                $studentContactData->pin_code = $request->pin_code;
                $studentContactData->email_id = $request->email_id;
                $studentContactData->pri_mbl_no = $request->pri_mobile;
                $studentContactData->sec_mbl_no = $request->sec_mobile;
                $studentContactData->save();

                $studentEducationData = new StudentEducationDetails;
                $studentEducationData->stud_unq_id = $studentBasicData->id;
                $studentEducationData->edu_qlf = $request->edu_qualification;
                $studentEducationData->edu_qlf_status = $request->edu_qlf_status;
                $studentEducationData->empl_status = $request->emp_status;
                $studentEducationData->trng_type = $request->trng_typ;
                $studentEducationData->sector = $request->sector;
                $studentEducationData->course = $request->course;
                $studentEducationData->save();

                $studentBankData = new StudentBankDetails;
                $studentBankData->stud_unq_id = $studentBasicData->id;
                $studentBankData->ifs_code = $request->ifs_code;
                $studentBankData->bank_name = $request->bank_name;
                $studentBankData->branch_name = $request->branch_name;
                $studentBankData->acc_no = $request->acc_num;
                $studentBankData->acc_hol_f_name = $request->acc_hold_name;
                $studentBankData->save();

                $studentAttachData = new StudentAttachmentDetails;
                $studentAttachData->stud_unq_id = $studentBasicData->id;

                $traineeImgName = $studentBasicData->id . '_' . 'trainee_' . time() . '.' . $request->trainee_photo->getClientOriginalExtension();
                $directory = 'attachment-Files/Trainee-Photo';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                $request->trainee_photo->move(public_path($directory), $traineeImgName);
                $studentAttachData->trainee_photo = $traineeImgName;

                // $traineeImgName = $studentBasicData->id . '_' . 'trainee_' . time(). '.' .$request->trainee_photo->getClientOriginalExtension();
                // $request->trainee_photo->move('attachment-Files/Trainee-Photo',$traineeImgName);
                // $studentAttachData->trainee_photo = $traineeImgName;

                $signatureImgName = $studentBasicData->id . '_' . 'signature_' . time(). '.' .$request->signature->getClientOriginalExtension();
                $directory = 'attachment-Files/Signature-Photo';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                $request->signature->move(public_path($directory), $signatureImgName);
                $studentAttachData->signature = $signatureImgName;

                $residImgName = $studentBasicData->id . '_' . 'resid_' . time(). '.' .$request->res_proof->getClientOriginalExtension();
                $directory = 'attachment-Files/Residatial-Photo';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                $request->res_proof->move(public_path($directory), $residImgName);
                $studentAttachData->resid_proof = $residImgName;

                $highQlfImgName = $studentBasicData->id . '_' . 'highQlf_' . time(). '.' .$request->high_qlf_proof->getClientOriginalExtension();
                $directory = 'attachment-Files/HighestQlf-Photo';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                $request->high_qlf_proof->move(public_path($directory), $highQlfImgName);
                $studentAttachData->highest_qlf_proof = $highQlfImgName;

                $ageProofImgName = $studentBasicData->id . '_' . 'ageProof_' . time(). '.' .$request->age_proof->getClientOriginalExtension();
                 $directory = 'attachment-Files/AgeProof-Photo';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                $request->age_proof->move(public_path($directory), $ageProofImgName);
                $studentAttachData->age_proof = $ageProofImgName;

                $bankPassImgName = $studentBasicData->id . '_' . 'bankPass_' . time(). '.' .$request->bank_pass->getClientOriginalExtension();
                 $directory = 'attachment-Files/BankPass-Photo';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                $request->bank_pass->move(public_path($directory), $bankPassImgName);
                $studentAttachData->bank_passbook = $bankPassImgName;

                if ($request->drv_lic != '') {
                    $drvLnsImgName = $studentBasicData->id . '_' . 'drvLns_' . time(). '.' .$request->drv_lic->getClientOriginalExtension();
                    $directory = 'attachment-Files/DriveLns-Photo';
                    if (!Storage::exists($directory)) {
                        Storage::makeDirectory($directory);
                    }
                    $request->drv_lic->move(public_path($directory), $drvLnsImgName);
                    $studentAttachData->drv_lns_proof = $drvLnsImgName;
                }

                if ($request->pass_proof != '') {
                    $passportImgName = $studentBasicData->id . '_' . 'passport_' . time(). '.' .$request->pass_proof->getClientOriginalExtension();
                    $directory = 'attachment-Files/PassPort-Photo';
                    if (!Storage::exists($directory)) {
                        Storage::makeDirectory($directory);
                    }
                    $request->pass_proof->move(public_path($directory), $passportImgName);
                    $studentAttachData->passport_proof = $passportImgName;
                }

                if ($request->ration_proof != '') {
                    $rationImgName = $studentBasicData->id . '_' . 'ration_' . time(). '.' .$request->ration_proof->getClientOriginalExtension();
                    $directory = 'attachment-Files/Ration-Photo';
                    if (!Storage::exists($directory)) {
                        Storage::makeDirectory($directory);
                    }
                    $request->ration_proof->move(public_path($directory), $rationImgName);
                    $studentAttachData->ration_proof = $rationImgName;
                }

                if ($request->aadhaar_proof != '') {
                    $aadhaarImgName = $studentBasicData->id . '_' . 'aadhaar_' . time(). '.' .$request->aadhaar_proof->getClientOriginalExtension();
                    $directory = 'attachment-Files/Aadhaar-Photo';
                    if (!Storage::exists($directory)) {
                        Storage::makeDirectory($directory);
                    }
                    $request->aadhaar_proof->move(public_path($directory), $aadhaarImgName);
                    $studentAttachData->aadhaar_proof = $aadhaarImgName;
                }

                if ($request->voter_proof != '') {
                    $voterImgName = $studentBasicData->id . '_' . 'voter_' . time(). '.' .$request->voter_proof->getClientOriginalExtension();
                    $directory = 'attachment-Files/Voter-Photo';
                    if (!Storage::exists($directory)) {
                        Storage::makeDirectory($directory);
                    }
                    $request->voter_proof->move(public_path($directory), $voterImgName);
                    $studentAttachData->voter_proof = $voterImgName;
                }
                $studentAttachData->save();

                return response()->json([
                    'status'=>true,
                    'message'=>'Student details added successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function viewStudent() {
		$title = 'Student List';
		return view('centre.student.studentList', compact('title'));
	}

    public function fetchRegStudent(Request $request){
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
                                            ->where('created_by', Auth::guard('centre')->user()->id);

            $total = $student->count();

            $totalFilter = StudentBasicDetails::select('student_basic_details.id', 'student_basic_details.s_f_name', 'student_basic_details.s_m_name', 'student_basic_details.s_l_name', 'student_basic_details.aadhaar_no', 'student_basic_details.dob', 'student_contact_details.email_id', 'student_contact_details.pri_mbl_no')
                                                ->join('student_contact_details', 'student_basic_details.id', '=', 'student_contact_details.stud_unq_id')
                                                ->where('created_by', Auth::guard('centre')->user()->id);

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
                                                ->where('created_by', Auth::guard('centre')->user()->id);

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
