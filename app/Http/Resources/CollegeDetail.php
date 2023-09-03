<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollegeDetail extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'user' => $this->user,
			'name' => $this->name,
			'website' => $this->website,
			'country' => $this->country,
			'city' => $this->city,
			'address' => $this->address,
			'logo' => $this->logo,
			'gallery_images' => $this->gallery_images,
			'total_student' => $this->total_student,
			'total_student_place_per_year' => $this->total_student_place_per_year,
			'about_college' => $this->about_college,
			'courses' => $this->courses,
			'special_note_employer' => $this->special_note_employer,
			'contact_person_name' => $this->contact_person_name,
			'contact_person_designation' => $this->contact_person_designation,
			'contact_person_email' => $this->contact_person_email,
			'contact_person_phone' => $this->contact_person_phone,
		];
	}
}
