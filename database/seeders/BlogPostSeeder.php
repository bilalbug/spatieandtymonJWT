<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            BlogPost::create([
                'blog_title' => $faker->sentence($nbWords = 10),
                'blog_context' =>  $faker->paragraphs(30, true),
                'user_id' => $faker->unique()->numberBetween(1,50),
                'category_id' => $faker->numberBetween(1,5),
            ]);
        }
    }
}
