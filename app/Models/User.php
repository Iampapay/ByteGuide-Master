<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {
	use Notifiable, HasApiTokens;
	use SoftDeletes;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_name','name', 'email', 'email_verified_at', 'password', 'phone_no', 'phone_no_verified_at', 'last_login', 'is_admin', 'user_unique_code', 'is_super_admin', 'user_type','teacher_type','created_by','updated_by',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/** test 123
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	/*public function getJWTIdentifier() {
		return $this->getKey();
	}*/

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	/*public function getJWTCustomClaims() {
		return [];
	}*/

	public function roles() {
		return $this->belongsToMany(Role::class, 'role_users');
	}

	/**
	 * Checks if User has access to $permissions.
	 */
	public function hasAccess(array $permissions): bool {
		// check if the permission is available in any role
		foreach ($this->roles as $role) {
			if ($role->hasAccess($permissions)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Checks if the user belongs to role.
	 */
	public function inRole(string $roleSlug) {
		return $this->roles()->where('slug', $roleSlug)->count() == 1;
	}

	public function adminUser() {
		return $this->hasOne(AdminDetail::class, 'user_id', 'id');
	}

	public function employeeUser() {
		return $this->hasOne(EmployeeProfileTxn::class, 'user_id', 'id');
	}

	public function employerUser() {
		return $this->hasOne(EmployerProfileTxn::class, 'user_id', 'id');
	}

	public function collegeUser() {
		return $this->hasOne(CollegeDetail::class, 'user_id', 'id');
	}

	public function franchiseUser() {
		return $this->hasOne(FranchiseDetail::class, 'user_id', 'id');
	}

	public function agencyUser() {
		return $this->hasOne(AgencyDetail::class, 'user_id', 'id');
	}

	public function galleryUser() {
		return $this->hasMany(EmployerGallery::class, 'user_id', 'id')->where('type', 'image');
	}

	public function videoGalleryUser() {
		return $this->hasOne(EmployerGallery::class, 'user_id', 'id')->where('type', 'url');
	}

	public function isEmployer() {
		$roles = $this->roles()->pluck('slug')->toArray();
		if (in_array('employer', $roles)) {
			return true;
		}
	}

	public function employerJobs() {
		return $this->hasMany(EmployerJobTxn::class, 'employer_id', 'id');
	}
	public function employerWalkin() {
		return $this->hasMany(WalkInInterviewTxn::class, 'employer_id', 'id');
	}

	public function employeeEmployementHistory() {
		return $this->hasMany(EmployeementHistory::class, 'user_id', 'id');
	}

	public function employeeEducation() {
		return $this->hasMany(EmployeeEducation::class, 'user_id', 'id');
	}

	public function employeeSkill() {
		return $this->hasMany(EmployeeSkill::class, 'user_id', 'id');
	}

	public function employeeCertification() {
		return $this->hasMany(EmployeeCertification::class, 'user_id', 'id');
	}

	public function employeeLanguage() {
		return $this->hasMany(EmployeeLanguages::class, 'user_id', 'id');
	}

	public function employeePrefTxn() {
		return $this->hasOne(EmployeePrefTxn::class, 'employee_id', 'id');
	}

	public function employeeVideos() {
		return $this->hasMany(EmployeeVideoTxn::class, 'employee_id', 'id');
	}

	public function employeeCvTxn() {
		return $this->hasOne(EmployeeCvTxn::class, 'employee_id', 'id');
	}

	public function getEmployeeCurrentCv() {
		$this->employeeCvTxn ? $this->employeeCvTxn()->orderBy('id', 'desc')->first() : '';
	}

	public function employeePhotos() {
		return $this->hasMany(EmployeePhoto::class, 'user_id', 'id');
	}

	public function employeeWalkinBook() {
		return $this->hasMany(InterviewSlotBook::class, 'user_id', 'id');
	}

}
