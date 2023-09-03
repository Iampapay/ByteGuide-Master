<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResource;
use App\Models\AllOtherMasterMst;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeProfile extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'user' => new UserResource($this->user),
			'name' => $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name,
			'gender' => $this->gender,
			'gender_text' => $this->gender_text,
			'date_of_birth' => $this->date_of_birth,
			'nationality' => $this->nationality,
			'home_town' => $this->home_town,
			'country_id' => $this->country_id,
			'country' => $this->country,
			'city_id' => $this->city_id,
			'city' => $this->city,
			'permanent_address' => $this->permanent_address,
			'present_address' => $this->present_address,
			'skype_id' => $this->skype_id,
			'cv' => $this->cv,
			'profile_picture' => $this->profile_picture,
			'profile_picture_image' => $this->profile_picture ? url('public/upload_files/profile_picture/' . $this->profile_picture) : '',
			'profile_title' => $this->profile_title,
			'total_experience' => $this->total_experience,
			'total_experience_data' => $this->total_experience ? AllOtherMasterMst::find($this->total_experience)->name : '',
			'notice_period' => $this->notice_period,
			'notice_period_data' => $this->notice_period ? AllOtherMasterMst::find($this->notice_period)->name : '',
			'current_salary' => $this->current_salary,
			'current_salary_data' => $this->current_salary ? AllOtherMasterMst::find($this->current_salary)->name : '',
			'summary' => $this->summary,
			'maritual_status' => $this->maritual_status,
			'married_status' => $this->married_status,
		];
	}

	public function employeeProfileCvSearch($request) {
		return [
			'id' => $this->id,
			//'user' => new UserResource($this->user),
			'name' => $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name,
			'gender' => $this->gender,
			'gender_text' => $this->gender_text,
			'date_of_birth' => $this->date_of_birth,
			'nationality' => $this->nationality,
			'home_town' => $this->home_town,
			'country_id' => $this->country_id,
			'country' => $this->country,
			'city_id' => $this->city_id,
			'city' => $this->city,
			'permanent_address' => $this->permanent_address,
			'present_address' => $this->present_address,
			'skype_id' => $this->skype_id,
			'cv' => $this->cv,
			'profile_picture' => $this->profile_picture,
			'profile_picture_image' => $this->profile_picture ? url('public/upload_files/profile_picture/' . $this->profile_picture) : '',
			'profile_title' => $this->profile_title,
			'total_experience' => $this->total_experience,
			'total_experience_data' => $this->total_experience ? AllOtherMasterMst::find($this->total_experience)->name : '',
			'notice_period' => $this->notice_period,
			'notice_period_data' => $this->notice_period ? AllOtherMasterMst::find($this->notice_period)->name : '',
			'current_salary' => $this->current_salary,
			'current_salary_data' => $this->current_salary ? AllOtherMasterMst::find($this->current_salary)->name : '',
			'summary' => $this->summary,
			'maritual_status' => $this->maritual_status,
			'married_status' => $this->married_status,
		];
	}

}
