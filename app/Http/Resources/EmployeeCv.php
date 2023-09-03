<?php

namespace App\Http\Resources;
use App\Http\Resources\EmployeeProfile;
use App\Http\Resources\EmployeePreference;
use App\Models\DegreeMst;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeCv extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$employee_profile = new EmployeeProfile($this->employeeUser);
		return [
			'id' => $this->id,
			'user_detail' => $employee_profile->employeeProfileCvSearch($this->employeeUser),
			'employeeEducation' => $this->employeeEducation->pluck('course_name'),
			'skill' => $this->employeeSkill->pluck('title'),
			//'cv' => $this->employeeCvTxn->cv_path ? \URL::to('/public/upload_files/employee-resumes/'.$this->employeeCvTxn->cv_path) : '',
			'desired_job' => new EmployeePreference($this->employeePrefTxn),
			'user_name' => $this->user_name,
			'email' => $this->email,
			'phone_no' => $this->phone_no,
			'last_login' => $this->last_login ? Carbon::parse($this->last_login)->format('d M Y') : Carbon::parse($this->created_at)->format('d M Y'),
			'updated_at' => Carbon::parse($this->updated_at)->format('d M Y'),
			'created_by' => $this->created_by,
			'updated_by' => $this->updated_by,
			'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
			

		];
	}
}
