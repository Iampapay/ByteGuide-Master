<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewSlotBook extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'interview_id' => $this->interview_id,
			'interview' => $this->interview,
			'employee' => $this->user,
			'booked_date' => Carbon::parse($this->booked_date)->format('d/m/Y'),
			'booked_time' => Carbon::parse($this->booked_time)->format('H:i'),
			'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
		];
	}
}
