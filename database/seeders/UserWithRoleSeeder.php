<?php

namespace Database\Seeders;

use App\Enums\UserStatusType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =[
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'password_pin' => bcrypt('1234'),
                'role_id' => 2,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Kasir 1',
                'username' => 'kasir1',
                'email' => 'kasir1@kasir.com',
                'password' => bcrypt('kasir1'),
                'password_pin' => bcrypt('11111'),
                'role_id' => 5,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Kasir 2',
                'username' => 'kasir2',
                'email' => 'kasir2@kasir.com',
                'password' => bcrypt('kasir2'),
                'password_pin' => bcrypt('22222'),
                'role_id' => 5,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Kasir 3',
                'username' => 'kasir3',
                'email' => 'kasir3@kasir.com',
                'password' => bcrypt('kasir3'),
                'password_pin' => bcrypt('33333'),
                'role_id' => 5,
                'status' => UserStatusType::INACTIVE(),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Kasir 4',
                'username' => 'kasir4',
                'email' => 'kasir4@kasir.com',
                'password' => bcrypt('kasir4'),
                'password_pin' => bcrypt('44444'),
                'role_id' => 5,
                'status' => UserStatusType::REMOVED(),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
