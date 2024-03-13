<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =[
            ['role' => 'Superadmin'],
            ['role' => 'Admin'],
            ['role' => 'Manajer'],
            ['role' => 'Pegawai'],
            ['role' => 'Kasir'],
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}
