<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePhoto extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'user_id' => $this->user_id,
			'description' => $this->description,
			'photo' => $this->photo,
			'photo_image' => $this->photo ? url('public/upload_files/images/' . $this->photo) : '',
		];
	}
}
