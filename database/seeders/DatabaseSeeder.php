<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Delivery;
use App\Models\Order;
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

        Delivery::create([
            'name' => "Royal Express",
            "slug" => 'royal_express',
        ]);
        Delivery::create([
            'name' => "S.O",
            "slug" => 's_o',
        ]);

        Collection::factory()
            ->count(10)
            ->create()
            ->each(function ($collection) {
                Order::factory()
                    ->count(3)
                    ->create([
                        'collection_id' => $collection->id, // Associate orders with the current collection
                    ]);
            });
    }
}
