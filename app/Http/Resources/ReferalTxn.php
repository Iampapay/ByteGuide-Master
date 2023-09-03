<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferalTxn extends JsonResource {
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
			'referal_name' => $this->referal_name,
			'referal_email' => $this->referal_email,
			'referal_designation' => $this->referal_designation,
			'referal_company' => $this->referal_company,
			'referal_company_website' => $this->referal_company_website,
			'message' => $this->message,
		];
	}
}
