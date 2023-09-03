<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public $permissionArray = [
		['name' => 'user-list', 'label' => 'User List', 'group_name' => 'users'],
		['name' => 'user-create', 'label' => 'User Create', 'group_name' => 'users'],
		['name' => 'user-edit', 'label' => 'User Edit', 'group_name' => 'users'],
		['name' => 'user-delete', 'label' => 'User Delete', 'group_name' => 'users'],
		['name' => 'role-list', 'label' => 'Role List', 'group_name' => 'roles'],
		['name' => 'role-create', 'label' => 'Role Create', 'group_name' => 'roles'],
		['name' => 'role-edit', 'label' => 'Role Edit', 'group_name' => 'roles'],
		['name' => 'role-delete', 'label' => 'Role Delete', 'group_name' => 'roles'],

	];

	public function run() {
		foreach ($this->permissionArray as $key => $value) {
			Permission::create($value);
		}
	}
}
