<?php

namespace App\Http\Resources;
use App\Http\Resources\EmployerDetails;
use App\Models\DegreeMst;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeerJobs extends JsonResource {
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
			'job_desc' => $this->job_desc,
			'job_role' => $this->jobRole,
			'employeer' => new EmployerDetails($this->employer),
			'industry_ids' => $this->industry()->pluck('id')->toArray(),
			'industry_name' => $this->industry()->pluck('name')->toArray(),
			'about_this_job' => $this->about_this_job,
			'job_posted_to_be' => $this->job_posted_to_be,
			'employement_for_id' => $this->employement_for,
			'employement_for' => $this->employmentFor,
			'required_skill' => $this->required_skill,
			'primary_responsibility' => $this->primary_responsibility,
			'special_notes' => $this->special_notes,
			'country_id' => $this->country_id,
			'country' => $this->country,
			'city_id' => $this->city_id,
			'city' => $this->city,
			'benefits' => $this->benefits,
			'min_qualification' => DegreeMst::whereIn('id', explode(',', $this->min_qualification))->pluck('id')->toArray(),
			'min_qualification_name' => DegreeMst::whereIn('id', explode(',', $this->min_qualification))->pluck('name')->toArray(),
			'max_qualification' => DegreeMst::whereIn('id', explode(',', $this->max_qualification))->pluck('id')->toArray(),
			'max_qualification_name' => DegreeMst::whereIn('id', explode(',', $this->max_qualification))->pluck('name')->toArray(),
			'graduate_and_or_post_graduate' => $this->graduate_and_or_post_graduate,
			'min_experiance_id' => $this->min_experiance,
			'min_experiance' => $this->minExperiance,
			'max_experiance_id' => $this->max_experiance,
			'max_experiance' => $this->maxExperiance,
			'language_pref_id' => $this->language()->pluck('id')->toArray(),
			'language_pref_name' => $this->language()->pluck('language_name')->toArray(),
			'employment_type_id' => $this->employment_type,
			'employment_type' => $this->employmentType,
			'number_of_vacancies' => $this->number_of_vacancies,
			'min_monthly_salary' => $this->min_monthly_salary,
			'max_monthly_salary' => $this->max_monthly_salary,
			'received_email' => $this->received_email,
			'currency' => $this->currency,
			'salary_type' => $this->salary_type,
			'job_status' => $this->job_status,
			'job_type' => $this->job_type == 1 ? 'free' : 'Premium',
			'job_ageing' => $this->job_ageing,
			'created_by' => $this->created_by,
			'updated_by' => $this->updated_by,
			'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
			'day_diff' => Carbon::now()->diffInDays($this->created_at),

		];
	}
}
