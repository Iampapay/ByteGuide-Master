<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeEducation extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'user_id' => $this->user_id,
			'course_title' => $this->course_title,
			'course_name' => $this->course_name,
			'specialization' => $this->specialization,
			'name_of_institute' => $this->name_of_institute,
			'institute_logo' => $this->institute_logo,
			'institute_logo_image' => url('public/upload_files/images/' . $this->institute_logo),
			'institute_website' => $this->institute_website,
			'course_type' => $this->course_type,
			'passout_year' => $this->passout_year,
		];
	}
}
