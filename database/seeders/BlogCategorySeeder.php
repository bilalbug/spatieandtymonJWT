<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            BlogCategory::create([
                'category_name' => $faker->unique()->randomElement(['Technology', 'Lifestyle', 'Travel', 'Food', 'Fashion']),

            ]);
        }
    }
}
