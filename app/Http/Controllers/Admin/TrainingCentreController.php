<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Role_User;
use App\Models\User;
use App\Models\CentreDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TrainingCentreController extends Controller
{
    public function createTrainingCentre() {
        $title = 'Admin | Center Registration';
		return view('admin.training_centre.centreRegistration', compact('title'));
    }

    public function addTrainingCentre(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'centre_name'=> 'required',
                'house_no'=> 'required',
                'street'=> 'required',
                'post_office'=> 'required',
                'police_station'=> 'required',
                'state'=> 'required',
                'dist'=> 'required',
                'block'=> 'required',
                'pin_code'=> 'required',
                'mob_no'=> 'required',
                'email_id'=> 'required',
                'lat'=> 'required',
                'long'=> 'required',
                'spos_name'=> 'required',
                'spos_mob'=> 'required',
                'spos_email'=> 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            }

            else {
                $centre_user = new User;
                $centre_user->user_name = $request->email_id;
                $centre_user->name = $request->centre_name;
                $centre_user->email = $request->email_id ;
                $centre_user->phone_no = $request->mob_no;
                $centre_user->password = Hash::make($request->mob_no);
                $centre_user->is_admin = 1;
                $centre_user->is_super_admin = 0;
                $centre_user->created_by = 1;
                $centre_user->save();

                $centre_details = new CentreDetails;
                $centre_details->centre_id = $centre_user->id;
                $centre_details->house_no = $request->house_no;
                $centre_details->street = $request->street;
                $centre_details->post_office = $request->post_office;
                $centre_details->police_station = $request->police_station;
                $centre_details->state = $request->state;
                $centre_details->dist = $request->dist;
                $centre_details->block = $request->block;
                $centre_details->pin_code = $request->pin_code;
                $centre_details->landline_no = $request->land_no;
                $centre_details->fax_no = $request->fax_no;
                $centre_details->web_url = $request->web_url;
                $centre_details->lat = $request->lat;
                $centre_details->long = $request->long;
                $centre_details->spoc_name = $request->spos_name;
                $centre_details->spoc_mob = $request->spos_mob;
                $centre_details->spoc_email = $request->spos_email;
                $centre_details->save();

                return response()->json([
                    'status'=>true,
                    'message'=>'Centre details added successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }
    }

    public function centreList(){
        $title = 'Admin | Center List';
        // $role_user=Role_User::where('role_id','=',3);
        $users = User::leftJoin('centre_details', 'users.id', '=', 'centre_details.centre_id')->where('is_admin', 1)->where('is_super_admin', 0)->orderBy('users.id', 'asc')->paginate(3);
        return view('admin.training_centre.centreList',compact('title', 'users'));
    }
}
