<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyDetail extends JsonResource {
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
			'comp_name' => $this->comp_name,
			'country' => $this->country,
			'city' => $this->city,
			'address' => $this->address,
			'contact_person_name' => $this->contact_person_name,
			'contact_person_designation' => $this->contact_person_designation,
			'contact_person_email' => $this->contact_person_email,
			'contact_person_phone' => $this->contact_person_phone,
			'registry_certificate' => $this->registry_certificate,
			'govt_id' => $this->govt_id,

		];
	}
}
