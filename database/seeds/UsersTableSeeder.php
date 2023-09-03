<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		User::create(['user_name' => 'user_principal', 'name'=> 'Principal','email' => 'principal@gmail.com', 'password' => bcrypt('12345678'),'is_admin' => 1, 'is_super_admin' => 1,'phone_no'=> '1234567876','user_type'=>1,'created_by'=>'1']);
	}
}
