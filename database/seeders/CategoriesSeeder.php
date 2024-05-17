<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Category 1',
                'description' => 'Description for category 1',
            ],
            [
                'name' => 'Category 2',
                'description' => 'Description for category 2',
            ],
            [
                'name' => 'Category 3',
                'description' => 'Description for category 3',
            ],
            [
                'name' => 'Category 4',
                'description' => 'Description for category 4',
            ],
            [
                'name' => 'Category 5',
                'description' => 'Description for category 5',
            ],
        ];

        foreach ($categories as $category) {
            Categorie::create($category);
        }
    }
}
