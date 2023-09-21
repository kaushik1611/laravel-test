<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'B2B product',
                'cost' => 500.00,
                'price' => 'price_1Nsfn6SGobGXc4mav1WFz5Jt',
                'stripe_product' => 'prod_Og1qRYKg8oWG1D',
                'description' => "This is B2B product.",
            ],
            [
                'name' => 'B2C product',
                'cost' => 200.00,
                'price' => 'price_1NsfmMSGobGXc4maghqfFY9h',
                'stripe_product' => 'prod_Og1q1yHzsty5Rc',
                'description' => "This is B2C product.",
            ]
        ];
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => strtolower($product['name']),
                'stripe_price' => $product['price'],
                'stripe_product' => $product['stripe_product'],
                'cost' => $product['cost'],
                'description' => $product['description']
            ]);
        }
    }
}
