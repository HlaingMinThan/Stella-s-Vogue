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

        $royal = Delivery::create([
            'name' => "Royal Express",
            "slug" => 'royal_express',
        ]);
        $so = Delivery::create([
            'name' => "S.O",
            "slug" => 's_o',
        ]);

        $olivia = Collection::factory()
            ->create([
                'name' => 'olivia'
            ]);
        //kpay 2 ways with royal on september 20000
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'hlaing min',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $royal->id,
            'payment' => 'kpay',
            'amount' => '10000',
            'created_at' => '2024-09-01'
        ]);
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'aungaung',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $royal->id,
            'payment' => 'kpay',
            'amount' => '10000',
            'created_at' => '2024-09-01'
        ]);
        //wave 3 ways with royal on september
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'mgmg',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $royal->id,
            'payment' => 'wave',
            'amount' => '10000',
            'created_at' => '2024-09-02'
        ]);
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'mgmg',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $royal->id,
            'payment' => 'wave',
            'amount' => '10000',
            'created_at' => '2024-09-05'
        ]);
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'mgmg',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $royal->id,
            'payment' => 'wave',
            'amount' => '10000',
            'created_at' => '2024-09-02'
        ]);

        //kpay 1 ways with so on september
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'hlaing min 2',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $so->id,
            'payment' => 'kpay',
            'amount' => '10000',
            'created_at' => '2024-09-02'
        ]);

        //wave 4 ways with so on sep
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'hlaing min 2',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $so->id,
            'payment' => 'wave',
            'amount' => '10000',
            'created_at' => '2024-09-02'
        ]);
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'hlaing min 2',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $so->id,
            'payment' => 'wave',
            'amount' => '10000',
            'created_at' => '2024-09-02'
        ]);
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'hlaing min 2',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $so->id,
            'payment' => 'wave',
            'amount' => '10000',
            'created_at' => '2024-09-10'
        ]);
        Order::factory()->create([
            'collection_id' => $olivia->id,
            'color' => 'red',
            'name' => 'hlaing min 2',
            'address' => 'yangon',
            'phone' => '09942377',
            'delivery_id' => $so->id,
            'payment' => 'wave',
            'amount' => '10000',
            'created_at' => '2024-09-02'
        ]);
    }
}
