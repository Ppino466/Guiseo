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
            'about' => 'admin',
            'status' => 1,
            'password' => ('123456789'),
            'created_at' => now()
        ]);

        User::create([   
            'name' => 'Juan',
            'last_name' => 'Ruiz',
            'email' => 'kiran82@gmail.com',
            'phone' => '(+52) 323-333-3333',
            'location' => 'gdl',
            'about' => 'empleado',
            'status' => 0,
            'password' => ('123456789'),
            'created_at' => now()
        ]);

    }
}
