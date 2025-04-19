<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SgoNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 500; $i++) {
            $subject = fake()->sentence(6);
            $slug = \Str::slug($subject);
            \DB::table('sgo_news')->insert([
                'category_id'     => fake()->randomElement([14, 24]),
                'subject'         => $subject,
                'short_name'         => fake()->name(),
                'slug'            => $slug,
                'posted_at'       => fake()->dateTimeBetween('-1 year', 'now'),
                'article'         => fake()->paragraphs(5, true),
                'is_favorite'     => fake()->boolean,
                'view'            => fake()->numberBetween(0, 1000),
                'created_at'      => now(),
                'updated_at'      => now(),
                'seo_title'       => fake()->sentence,
                'seo_description' => fake()->text(160),
                'tags'            => implode(',', fake()->words(5)),
                'status'          => fake()->randomElement(['published', 'unpublished']),
                'summary'         => fake()->text(300),
            ]);
        }
    }
}
