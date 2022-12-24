<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'role_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456Kk@'),
                'remember_token' => null,
                'verified' => 1,
                'verified_at' => '2022-06-15 13:47:44',
                'verification_token' => '',
                'two_factor_code' => '',
            ],
        ];
        User::insert($users);
    }
}
