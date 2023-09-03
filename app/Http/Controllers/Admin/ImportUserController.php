<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Validator;

use Maatwebsite\Excel\Facades\Excel;

class ImportUserController extends Controller
{
    public function import_user(){
        $title = 'Admin | Excel';
        return view('admin.import_student.list')->with(compact('title'));
    }

    public function importData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'import_student'=> 'required'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors()->first()
                ]);
            } else {
                $file = $request->file('import_student');
                Excel::import(new UsersImport, $file);
                return response()->json([
                    'status'=>true,
                    'message'=>'Student details imported successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json(['status' => false, 'errors'=> $e->getMessage()]);
        }

    }
}

?>
