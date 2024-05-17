<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'Supplier 1',
                'contact_name' => 'Contact Name 1',
                'address' => 'Address 1',
                'phone' => '123456789',
                'email' => 'supplier1@example.com',
            ],
            [
                'name' => 'Supplier 2',
                'contact_name' => 'Contact Name 2',
                'address' => 'Address 2',
                'phone' => '987654321',
                'email' => 'supplier2@example.com',
            ],
            [
                'name' => 'Supplier 3',
                'contact_name' => 'Contact Name 3',
                'address' => 'Address 3',
                'phone' => '111222333',
                'email' => 'supplier3@example.com',
            ],
            [
                'name' => 'Supplier 4',
                'contact_name' => 'Contact Name 4',
                'address' => 'Address 4',
                'phone' => '444555666',
                'email' => 'supplier4@example.com',
            ],
            [
                'name' => 'Supplier 5',
                'contact_name' => 'Contact Name 5',
                'address' => 'Address 5',
                'phone' => '777888999',
                'email' => 'supplier5@example.com',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
