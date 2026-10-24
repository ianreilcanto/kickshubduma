<?php

namespace Database\Seeders;

use App\Models\Athlete;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class StorefrontSeeder extends Seeder
{
    public function run(): void
    {
        $brand = Brand::firstOrCreate(['slug' => 'kicks-hub-duma'], ['name' => 'Kicks Hub Duma']);

        $categories = collect([
            'shoes' => 'Shoes',
            'paddle' => 'Paddle',
            'kits' => 'Kits',
        ])->map(fn ($name, $slug) => Category::firstOrCreate(['slug' => $slug], ['name' => $name]));

        $products = [
            ['KHD-001', 'Baseline 01', 'shoes', 4250, 'Court', 'Court shoe', 'Varsity Red', 'BEST SELLER', [7, 8, 9, 10, 11]],
            ['KHD-002', 'Baseline 02', 'shoes', 3890, 'Lifestyle', 'Everyday shoe', 'Sandstone', 'NEW COLOUR', [6, 7, 8, 9, 10]],
            ['KHD-003', 'Rally Court Pro', 'shoes', 5290, 'Court', 'Performance shoe', 'Deep Blue', null, [7, 8, 9, 10, 11]],
            ['KHD-004', 'Daily Pace', 'shoes', 3490, 'Running & training', 'Training shoe', 'Olive', null, [6, 7, 8, 9, 10]],
            ['KHD-005', 'Dink One Paddle', 'paddle', 2890, 'Court', 'Pickleball paddle', 'Carbon', 'COURT PICK', [8, 9, 10, 11]],
            ['KHD-006', 'Club Training Set', 'kits', 1990, 'Running & training', 'Training kit', 'Navy / Cream', null, [6, 7, 8, 9, 10, 11]],
            ['KHD-007', 'Baseline Street', 'shoes', 3790, 'Lifestyle', 'Lifestyle shoe', 'Chalk', null, [6, 7, 8, 9, 10, 11]],
            ['KHD-008', 'Court Ready Kit', 'kits', 1590, 'Court', 'Activewear set', 'Varsity Red', 'JUST LANDED', [7, 8, 9, 10, 11]],
        ];

        foreach ($products as [$sku, $name, $category, $price, $activity, $description, $color, $badge, $sizes]) {
            Product::firstOrCreate(['sku' => $sku], [
                'brand_id' => $brand->id,
                'category_id' => $categories[$category]->id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'activity' => $activity,
                'color' => $color,
                'badge' => $badge,
                'sizes' => array_map('strval', $sizes),
                'stock' => 50,
                'is_active' => true,
            ]);
        }

        $athletes = [
            ['nico-reyes', 'Nico Reyes', 'Basketball', 'The Court Regular', 'One more game. One more lesson.', 'For Nico, basketball is a daily ritual. A few quiet drills before the city wakes up. One more pickup game with the neighborhood crew. He plays for the rhythm, the friendships, and the feeling of getting a little better.', 'Baseline 01', 'Keep showing up', true],
            ['andi-mercado', 'Andi Mercado', 'Running', 'The Early Riser', 'The first step is always yours.', null, 'Daily Pace', 'Start before the noise', false],
            ['jules-lim', 'Jules Lim', 'Paddle', 'The Social Player', 'Good rallies start with good people.', null, 'Dink One Paddle', 'Play with your people', false],
        ];

        foreach ($athletes as $i => [$slug, $name, $sport, $tagline, $quote, $bio, $product, $mindset, $featured]) {
            Athlete::firstOrCreate(['slug' => $slug], [
                'name' => $name,
                'sport' => $sport,
                'tagline' => $tagline,
                'quote' => $quote,
                'bio' => $bio,
                'home_court' => 'Dumaguete',
                'go_to_product_id' => Product::where('name', $product)->value('id'),
                'mindset' => $mindset,
                'is_featured' => $featured,
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }
    }
}
