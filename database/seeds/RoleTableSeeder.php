<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Role::create(['name' => 'Principal', 'slug' => 'principal','created_by'=>1, 'permissions' => json_encode(['all' => 'true'])]);
	}
}
