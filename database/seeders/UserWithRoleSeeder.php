<?php

namespace Database\Seeders;

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
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
