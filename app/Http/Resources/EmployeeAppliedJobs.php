<?php

namespace App\Http\Resources;
use App\Http\Resources\EmployeerJobs;
use App\Http\Resources\EmployeeCv;
use App\Models\ApplicationPhaseMst;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeAppliedJobs extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'job_id' => $this->job_id,
			'job' => new EmployeerJobs($this->job),
			'applied_date' => $this->applied_date ? Carbon::parse($this->applied_date)->format('Y-m-d') : '',
			'applied_status' => $this->applicationStatus,
			'application_phase_complete' => ApplicationPhaseMst::where('id', '<=', $this->applied_status)->pluck('id')->toArray(),
			'employee' => $this->employee,
			'employee_profile' => new EmployeeCv($this->employee),
			'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d') : '',
			'day_diff' => Carbon::now()->diffInDays($this->created_at),

		];
	}
}
