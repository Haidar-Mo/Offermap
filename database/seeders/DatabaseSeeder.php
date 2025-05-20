<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Branch;
use App\Models\Media;
use App\Models\Rate;
use App\Models\Store;
use App\Models\User;
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
        User::factory()->has(Store::factory()
            ->has(Branch::factory()->count(3)
                ->has(Advertisement::factory()->active()->count(5)
                    ->has(View::factory()->count(10))
                    ->has(Media::factory()->count(2)))
                ->has(Rate::factory()->count(7))))
            ->create();
    }
}
