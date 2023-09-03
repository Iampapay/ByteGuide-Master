<?php

namespace App\Http\Resources;
use App\Http\Resources\EmployerProfile;
use App\Models\DegreeMst;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WalkInInterview extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'job_title' => $this->job_title,
			'employeer' => new EmployerProfile($this->employer->employerUser),
			'city_id' => $this->city_id,
			'industry_ids' => $this->industry()->pluck('id')->toArray(),
			'industry_name' => $this->industry()->pluck('name')->toArray(),
			'about_this_job' => $this->about_this_job,
			'employement_for' => $this->employement_for,
			'position_offered' => $this->position_offered,
			'number_of_vacancies' => $this->number_of_vacancies,
			'employment_type' => $this->employment_type,
			'min_experiance' => $this->minExperiance,
			'max_experiance' => $this->maxExperiance,
			'min_qualification' => DegreeMst::whereIn('id', explode(',', $this->min_qualification))->pluck('id')->toArray(),
			'min_qualification_name' => DegreeMst::whereIn('id', explode(',', $this->min_qualification))->pluck('name')->toArray(),
			'max_qualification' => DegreeMst::whereIn('id', explode(',', $this->max_qualification))->pluck('id')->toArray(),
			'max_qualification_name' => DegreeMst::whereIn('id', explode(',', $this->max_qualification))->pluck('name')->toArray(),
			'currency' => $this->currency,
			'salary_type' => $this->salary_type,
			'min_monthly_salary' => $this->min_monthly_salary,
			'max_monthly_salary' => $this->max_monthly_salary,
			'language_pref_id' => $this->language()->pluck('id')->toArray(),
			'language_pref_name' => $this->language()->pluck('language_name')->toArray(),
			'edu_and_or' => $this->edu_and_or,
			'interview_name' => $this->interview_name,
			'interview_type_id' => $this->interview_type_id,
			'interview_type' => $this->interviewType,
			'interview_date' => $this->interview_date,
			'interview_dates' => $this->getDates($this->interview_date),
			'interview_start_time' => $this->interview_start_time,
			'interview_end_time' => $this->interview_end_time,
			'interview_time_slot' => $this->interview_time_slot,
			'time_slots' => $this->getTimeSlots($this->interview_start_time, $this->interview_end_time, $this->interview_time_slot),
			'interview_vanue_name' => $this->interview_vanue_name,
			'interview_location_country' => $this->interview_location_country,
			'interview_location_country_name' => $this->country,
			'interview_location_city' => $this->interViewLocation,
			'interview_venue_address' => $this->interview_venue_address,
			'status' => $this->status,
			'created_by' => $this->created_by,
			'updated_by' => $this->updated_by,
			'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),

		];
	}

	protected function getDates($dates) {
		$dateArray = [];
		$date = explode(',', $dates);
		$start = Carbon::parse($date[0]);
		$diff = $start->diffInDays(Carbon::parse($date[1]));
		for ($i = 0; $i <= $diff; $i++) {
			array_push($dateArray, Carbon::parse($date[0])->addDay($i)->format('d/m/Y'));
		}
		return $dateArray;
	}

	protected function getTimeSlots($start_time, $end_time, $interv_slot) {
		$start = Carbon::parse($start_time);
		$end = Carbon::parse($end_time);
		$diff_in_minutes = $end->diffInMinutes($start);
		$slotArray = [];
		$diffSlot = $diff_in_minutes / $interv_slot;
		for ($i = 0; $i <= $diffSlot; $i++) {
			array_push($slotArray, Carbon::parse($start_time)->addMinutes($interv_slot * $i)->format('H:i'));
		}
		return $slotArray;
	}
}
