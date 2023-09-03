<?php

namespace App\Http\Resources;
use App\Http\Resources\AgencyDetail as AgencyDetailResource;
use App\Http\Resources\CollegeDetail as CollegeDetailResource;
use App\Http\Resources\EmployerProfile;
use App\Http\Resources\FranchiseDetail as FranchiseDetailResource;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'user_name' => $this->user_name,
			'email' => $this->email,
			'password' => $this->password,
			'phone_no' => $this->phone_no,
			'last_login' => $this->last_login ? Carbon::parse($this->last_login)->format('d M Y') : Carbon::parse($this->created_at)->format('d M Y'),
			'profile_update' => $this->profile_update,
			'updated_at' => Carbon::parse($this->updated_at)->format('d M Y'),
			'is_employer' => Auth::user()->isEmployer() ? Auth::user()->isEmployer() : false,
			'user_detail' => $this->getUserDetail($this->roles()->first()),
			'gallery_images' => $this->galleryUser,
			'video_link' => $this->videoGalleryUser,

		];
	}

	public function getUserDetail($role) {
		$data = '';
		switch ($role->slug) {
		case 'employee':
			$data = $this->employeeUser;
			break;
		case 'employer':
			$data = new EmployerProfile($this->employerUser);
			break;
		case 'college':
			$data = new CollegeDetailResource($this->collegeUser);
			break;
		case 'agency':
			$data = new AgencyDetailResource($this->agencyUser);
			break;
		case 'franchise':
			$data = new FranchiseDetailResource($this->franchiseUser);
			break;
		default:
			// code...
			break;
		}

		return $data;
	}
}
