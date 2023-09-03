<?php

namespace App\Http\Resources;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeementHistory extends JsonResource {
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
			'job_title' => $this->job_title,
			'company_logo' => $this->company_logo,
			'company_logo_image' => $this->company_logo ? url('public/upload_files/images/' . $this->company_logo) : '',
			'company_name' => $this->company_name,
			'company_website' => $this->company_website,
			'industry_of_company' => $this->industry_of_company,
			'industry_name' => $this->industry ? $this->industry->name : '',
			'department' => $this->department,
			'department_name' => $this->department_names ? $this->department_names->role_name : '',
			'from_date' => $this->from_date ? Carbon::parse($this->from_date)->format('d/m/Y') : '',
			'to_date' => $this->to_date ? Carbon::parse($this->to_date)->format('d/m/Y') : '',
		];
	}
}
