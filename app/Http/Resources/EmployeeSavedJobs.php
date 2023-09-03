<?php

namespace App\Http\Resources;
use App\Http\Resources\EmployeerJobs;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeSavedJobs extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'job' => new EmployeerJobs($this->job),
			'applied_date' => $this->applied_date ? Carbon::parse($this->applied_date)->format('Y-m-d') : '',
			'employee' => $this->employee,
			'saved_on' => $this->saved_on ? Carbon::parse($this->saved_on)->format('Y-m-d') : '',
			'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d') : '',
			'day_diff' => Carbon::now()->diffInDays($this->created_at),
		];
	}
}
