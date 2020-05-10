<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 'admin',
            'active_status' => 'active',
            'role_status' => 'admin',
            'profile_image' => 'none',
            'suspend_status' => 'unsuspend',
            'referral_code'=> "amd1in"
        ]);
    }
}
