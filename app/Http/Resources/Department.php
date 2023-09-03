<?php

namespace App\Http\Resources;
use App\Models\DepartmentMst;
use Illuminate\Http\Resources\Json\JsonResource;

class Department extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'name' => $this->name,
			'parent_name' => $this->parent_id ? $this->getParent($this->parent_id)->name : '',
			'parent' => $this->parent_id ? $this->getParent($this->parent_id) : '',
		];
	}

	private function getParent($parent_id) {
		return DepartmentMst::where('id', $parent_id)->first();
	}

}
