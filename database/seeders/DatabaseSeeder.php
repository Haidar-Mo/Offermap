<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Branch;
use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\View;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);


        // Create a user with a store and 3 branches
        User::factory()->has(
            factory: Store::factory()->has(
                factory: Branch::factory()->count(3)->has(
                    factory: Advertisement::factory()->active()->count(5)->has(
                        factory: View::factory()->count(10)
                    )
                )
            )
        )
            ->create();
    }
}
