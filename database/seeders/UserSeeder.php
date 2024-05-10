<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([   
            'name' => 'Guillermo',
            'last_name' => 'Garcia',
            'email' => 'biohazardm3@gmail.com',
            'phone' => '(+52) 333-333-3333',
            'location' => 'gdl',
            'about' => 'text long example',
            'status' => 1,
            'password' => ('123456789'),
            'created_at' => now()
        ]);

    }
}
