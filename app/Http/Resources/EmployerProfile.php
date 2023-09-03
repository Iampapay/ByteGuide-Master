<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployerProfile extends JsonResource {
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
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'name' => $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name,
			'company_name' => $this->company_name,
			'industry'=>$this->industry_id,
			'industry_details'=>$this->industry_id ? new Industry($this->industry):'',
			'address' => $this->address,
			'city_id' => $this->city_id,
			'city' => $this->city,
			'zipcode' => $this->zipcode,
			'country_id' => $this->country_id,
			'country' => $this->country,
			'designation' => $this->designation,
			'company_logo' => $this->company_logo ? \URL::to('/public/upload_files/employer/logo/'.$this->company_logo) : '',
			'company_main_image' => $this->company_main_image,
			'alternate_ph_no' => $this->alternate_ph_no,
			'company_type' => $this->company_type,
			'company_type_details' => $this->company_type ? new CompanyType($this->companyType) : '',
			'company_size' => $this->company_size,
			'company_size_details' => $this->company_size ? new CompanySize($this->companySize) : '',
			'company_tagline' => $this->company_tagline,
			'company_short_desc' => $this->company_short_desc,
			'element' => $this->element,
			'nearby_place' => $this->nearby_place,
			'gender' => $this->gender_text,
			'date_of_birth' => $this->date_of_birth,
			'category' => $this->category,
			'profile_picture' => $this->profile_picture ? \URL::to('/public/upload_files/profile_picture/'.$this->profile_picture) : '',
			'is_complete' => $this->is_complete,
			'company_website' => $this->company_website,
			'company_email' => $this->company_email,
		];
	}
}
