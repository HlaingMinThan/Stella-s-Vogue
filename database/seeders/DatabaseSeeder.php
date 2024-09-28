<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
        $staff = Role::create([
            'name' => 'Staff',
            'slug' => 'staff',
        ]);

        User::factory()->create([
            'name' => 'Stella',
            'email' => 'admin@gmail.com',
            'role_id' => $admin->id
        ]);
        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'role_id' => $staff->id
        ]);
    }
}
