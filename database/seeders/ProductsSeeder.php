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
                'name' => 'Product 1',
                'description' => 'Descripción 1',
                'price' => 10.99,
                'supplier_id' => 1,
                'category_id' => 1,
                'sku' => 'SKU001'
            ],
            [
                'name' => 'Product 2',
                'description' => 'Descripción 2',
                'price' => 10.99,
                'supplier_id' => 1,
                'category_id' => 2,
                'sku' => 'SKU002'
            ],
            [
                'name' => 'Product 3',
                'description' => 'Descripción 3',
                'price' => 10.99,
                'supplier_id' => 1,
                'category_id' => 2,
                'sku' => 'SKU003'
            ],
            [
                'name' => 'Product 4',
                'description' => 'Descripción 4',
                'price' => 10.99,
                'supplier_id' => 1,
                'category_id' => 2,
                'sku' => 'SKU004'
            ],
            [
                'name' => 'Product 5',
                'description' => 'Descripción 4',
                'price' => 10.99,
                'supplier_id' => 1,
                'category_id' => 2,
                'sku' => 'SKU005'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
