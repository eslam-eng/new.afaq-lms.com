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
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@gmail.com',
                'password'           => bcrypt('123456'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-10-11 16:07:37',
                'verification_token' => '',
                'full_name_en'       => '',
                'full_name_ar'       => '',
                'phone'              => '',
                'country'            => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'User',
                'email'              => 'user@user.com',
                'password'           => bcrypt('123456'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-10-11 16:07:37',
                'verification_token' => '',
                'full_name_en'       => '',
                'full_name_ar'       => '',
                'phone'              => '',
                'country'            => '',
            ],
        ];

        User::insert($users);
    }
}
