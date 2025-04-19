<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 0; $i < 100; $i++) {
        //     DB::table('tags')->insert([
        //         'tag' => fake()->name(),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        $newsTags = [];

        foreach (range(1, 10) as $productId) {
            $numberOfTags = rand(4, 5);
            $tagIds = [];

            while (count($tagIds) < $numberOfTags) {
                $randomTag = rand(101, 200);
                if (!in_array($randomTag, $tagIds)) {
                    $tagIds[] = $randomTag;
                }
            }

            foreach ($tagIds as $tagId) {
                $newsTags[] = [
                    'product_id' => $productId,
                    'tag_id' => $tagId,
                ];
            }
        }

        // Chia nhỏ để tránh quá tải khi insert
        foreach (array_chunk($newsTags, 500) as $chunk) {
            DB::table('product_tag')->insert($chunk);
        }

        echo "✅ Đã gán ngẫu nhiên tag cho 500 bài viết.\n";
    }
}
