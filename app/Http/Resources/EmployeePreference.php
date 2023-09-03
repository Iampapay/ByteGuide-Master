<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePreference extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'employee_id' => $this->employee_id,
			'country_id' => $this->country_id,
			'country_name' => $this->country ? $this->country->name : '',
			'job_location' => $this->job_location,
			'industry_id' => $this->industry_id,
			'industry_name' => $this->industry ? $this->industry->name : '',
			'department_id' => $this->department_id,
			'department_name' => $this->jobRole ? $this->jobRole->role_name : '',
			'city_id' => $this->city_id,
			'city_name' => $this->city ? $this->city->name : '',
			'job_role_id' => $this->job_role_id,
			'shift_type' => $this->shift_type,
			'job_type' => $this->job_type,
			'job_type_text' => ($this->job_type == 1) ? 'Full time' : 'Part Time',
			'currency_type' => $this->currency_type,
			'min_salary' => $this->min_salary,
			'max_salary' => $this->max_salary,
			'salary_type' => $this->salary_type,
			'created_by' => $this->created_by,

		];
	}
}
