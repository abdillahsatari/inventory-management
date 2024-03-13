<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\InventorySeeder;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(InventorySeeder::class);
        // $this->call(CustomerSeeder::class);

        $this->call([
            InventorySeeder::class,
            CustomerSeeder::class,
            RoleSeeder::class,
            UserWithRoleSeeder::class
        ]);
    }
}
