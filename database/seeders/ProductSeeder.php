<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $tshirts = Category::where('slug', 't-shirts')->first();
        $hoodies = Category::where('slug', 'hoodies')->first();
        $hats = Category::where('slug', 'hats')->first();
        $accessories = Category::where('slug', 'accessories')->first();
        $wrestling = Category::where('slug', 'wrestling')->first();

        // T-Shirts
        $products = [
            [
                'category_id' => $tshirts->id,
                'name' => 'Choose Loyalty Tee',
                'slug' => 'choose-loyalty-tee',
                'description' => 'Our signature tee featuring the iconic "Choose Loyalty" slogan. Premium cotton blend for all-day comfort. Perfect for bikers, fighters, and those who stand strong.',
                'price' => 34.99,
                'active' => true,
            ],
            [
                'category_id' => $tshirts->id,
                'name' => 'Villainy Thrives Logo Tee',
                'slug' => 'villainy-thrives-logo-tee',
                'description' => 'Classic black tee with bold Villainy Thrives logo. Represent the movement with pride. Built tough for blue-collar warriors.',
                'price' => 32.99,
                'active' => true,
            ],
            [
                'category_id' => $tshirts->id,
                'name' => 'Rebel Heart Tee',
                'slug' => 'rebel-heart-tee',
                'description' => 'For those who refuse to bow down. Heavyweight cotton with striking graphic design. Born from resilience, made for the loyal.',
                'price' => 36.99,
                'active' => true,
            ],

            // Hoodies
            [
                'category_id' => $hoodies->id,
                'name' => 'Loyalty Heavyweight Hoodie',
                'slug' => 'loyalty-heavyweight-hoodie',
                'description' => 'Premium pullover hoodie with Villainy Thrives embroidery. Fleece-lined for maximum warmth. This is armor for the loyal.',
                'price' => 64.99,
                'active' => true,
            ],
            [
                'category_id' => $hoodies->id,
                'name' => 'Villain Mode Zip-Up',
                'slug' => 'villain-mode-zip-up',
                'description' => 'Full zip hoodie with aggressive graphics and reinforced stitching. Built for those who choose villainy over conformity.',
                'price' => 69.99,
                'active' => true,
            ],

            // Hats
            [
                'category_id' => $hats->id,
                'name' => 'VT Logo Snapback',
                'slug' => 'vt-logo-snapback',
                'description' => 'Classic snapback with 3D embroidered Villainy Thrives logo. One size fits all. Rep the brand everywhere you go.',
                'price' => 29.99,
                'active' => true,
            ],
            [
                'category_id' => $hats->id,
                'name' => 'Choose Loyalty Beanie',
                'slug' => 'choose-loyalty-beanie',
                'description' => 'Warm winter beanie with woven "Choose Loyalty" patch. Perfect for cold rides and late nights.',
                'price' => 24.99,
                'active' => true,
            ],

            // Accessories
            [
                'category_id' => $accessories->id,
                'name' => 'VT Patch Pack',
                'slug' => 'vt-patch-pack',
                'description' => 'Set of 3 iron-on patches featuring Villainy Thrives designs. Customize your jacket, vest, or bag.',
                'price' => 14.99,
                'active' => true,
            ],
            [
                'category_id' => $accessories->id,
                'name' => 'Loyalty Sticker Pack',
                'slug' => 'loyalty-sticker-pack',
                'description' => '10 premium vinyl stickers. Waterproof and UV-resistant. Stick them on your bike, toolbox, or laptop.',
                'price' => 9.99,
                'active' => true,
            ],

            // Wrestling
            [
                'category_id' => $wrestling->id,
                'name' => 'Squared Circle Tee',
                'slug' => 'squared-circle-tee',
                'description' => 'Wrestling-inspired graphic tee for fans of the sport. Honors the warriors who battle in the ring with loyalty and heart.',
                'price' => 34.99,
                'active' => true,
            ],
            [
                'category_id' => $wrestling->id,
                'name' => 'Heel Turn Hoodie',
                'slug' => 'heel-turn-hoodie',
                'description' => 'Embrace your inner villain with this wrestling-themed hoodie. Sometimes the bad guys are the loyal ones.',
                'price' => 64.99,
                'active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
