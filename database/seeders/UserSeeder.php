<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make('password'),
//                'user_role' => $faker->unique()->randomElement(['manage-users', 'manage-roles', 'manage-permissions', 'manage-blog-posts', 'manage-categories',]),
                'email_verified_at' => $faker->dateTime,
            ]);
        }
    }
}
