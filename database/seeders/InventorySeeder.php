<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'quantity' => 5,
                'location' => 'bodega 1',
                'entry_date' => '2024-05-22',
                'last_sale_date' => null,
                'min_quantity' => 1,
                'max_quantity' => 10,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => null
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'quantity' => 5,
                'location' => 'bodega',
                'entry_date' => '2024-05-22',
                'last_sale_date' => null,
                'min_quantity' => 1,
                'max_quantity' => 10,
                'status' => 'inactive',
                'created_at' => '2024-05-22 15:53:44',
                'updated_at' => null
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'quantity' => 0,
                'location' => 'bodega',
                'entry_date' => '2024-05-22',
                'last_sale_date' => null,
                'min_quantity' => 1,
                'max_quantity' => 10,
                'status' => 'pending_restock',
                'created_at' => '2024-05-22 15:54:37',
                'updated_at' => null
            ],
            [
                'id' => 4,
                'product_id' => 4,
                'quantity' => 7,
                'location' => 'bodega',
                'entry_date' => '2024-05-22',
                'last_sale_date' => null,
                'min_quantity' => 1,
                'max_quantity' => 10,
                'status' => 'active',
                'created_at' => '2024-05-22 15:55:22',
                'updated_at' => null
            ],
            [
                'id' => 5,
                'product_id' => 5,
                'quantity' => 9,
                'location' => 'bodega',
                'entry_date' => '2024-05-22',
                'last_sale_date' => null,
                'min_quantity' => 1,
                'max_quantity' => 10,
                'status' => 'active',
                'created_at' => '2024-05-22 15:55:22',
                'updated_at' => null
            ],
        ]);
    }
}
