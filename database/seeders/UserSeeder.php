<?php

namespace Database\Seeders;

use Vanguard\Role;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(30)->create();
//        $admin = Role::where('name', 'User')->first();
//
//
//        User::create([
//            'first_name' => 'hht',
//            'email' => 'admin@example.com',
//            'username' => 'admin',
//            'password' => 'admin123',
//            'avatar' => null,
//            'country_id' => null,
//            'role_id' => $admin->id,
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => now(),
//        ]);
    }
}
