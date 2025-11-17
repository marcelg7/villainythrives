<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'T-Shirts',
                'slug' => 't-shirts',
                'description' => 'Bold graphic tees for those who choose loyalty. Built for bikers, fighters, and blue-collar warriors.',
                'active' => true,
            ],
            [
                'name' => 'Hoodies',
                'slug' => 'hoodies',
                'description' => 'Premium hoodies designed for comfort and attitude. Embrace your inner villain.',
                'active' => true,
            ],
            [
                'name' => 'Hats',
                'slug' => 'hats',
                'description' => 'Snapbacks and beanies for the loyal. Rep the brand wherever you go.',
                'active' => true,
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Patches, stickers, and gear to complete your villainous look.',
                'active' => true,
            ],
            [
                'name' => 'Wrestling',
                'slug' => 'wrestling',
                'description' => 'Exclusive wrestling-inspired apparel and collectibles for the squared circle loyalists.',
                'active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
