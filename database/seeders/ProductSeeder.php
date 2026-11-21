<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Mouse',
                'price' => 599.00,
                'stock_quantity' => 20,
            ],
            [
                'name' => 'Mechanical Keyboard',
                'price' => 1499.00,
                'stock_quantity' => 15,
            ],
            [
                'name' => 'USB-C Cable',
                'price' => 249.00,
                'stock_quantity' => 30,
            ],
            [
                'name' => 'Laptop Stand',
                'price' => 799.00,
                'stock_quantity' => 12,
            ],
            [
                'name' => 'USB Headset',
                'price' => 999.00,
                'stock_quantity' => 10,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'price' => $product['price'],
                    'stock_quantity' => $product['stock_quantity'],
                    'image' => null,
                ]
            );
        }
    }
}