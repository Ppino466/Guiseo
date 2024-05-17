<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            [
                'sku' => 'SKU001',
                'name' => 'Product 1',
                'price' => 10.99,
                'stock' => 100,
                'category_id' => 1,
            ],
            [
                'sku' => 'SKU002',
                'name' => 'Product 2',
                'price' => 19.99,
                'stock' => 50,
                'category_id' => 2,
            ],
            [
                'sku' => 'SKU003',
                'name' => 'Product 3',
                'price' => 5.99,
                'stock' => 200,
                'category_id' => 3,
            ],
            [
                'sku' => 'SKU004',
                'name' => 'Product 4',
                'price' => 15.50,
                'stock' => 75,
                'category_id' => 1,
            ],
            [
                'sku' => 'SKU005',
                'name' => 'Product 5',
                'price' => 8.75,
                'stock' => 120,
                'category_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
