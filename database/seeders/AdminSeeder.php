<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'mario',
            'last_name' => 'androws',
            'email' => 'admin@gmail.com',
            'phone_number' => '0937723418',
            'password' => bcrypt('123456789'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        $user->assignRole('admin');



        $haidar = User::create([
            'first_name' => 'mohammad',
            'last_name' => 'haidar',
            'email' => 'haidar@gmail.com',
            'phone_number' => '0936287134',
            'password' => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $haidar->assignRole('admin');

    }
}
