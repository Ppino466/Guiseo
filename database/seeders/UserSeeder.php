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
       $userMaster = User::create([   
            'name' => 'Guillermo',
            'last_name' => 'Garcia',
            'email' => 'biohazardm3@gmail.com',
            'phone' => '333-333-3333',
            'location' => 'gdl',
            'about' => 'master',
            'status' => 1,
            'password' => ('123456789'),
            'created_at' => now(),
            'updated_at' => null
        ]); 

        $userAdmin = User::create([   
            'name' => 'Juan',
            'last_name' => 'Ruiz',
            'email' => 'admin@gmail.com',
            'phone' => '323-333-3333',
            'location' => 'gdl',
            'about' => 'admin',
            'status' => 1,
            'password' => ('123456789'),
            'created_at' => now(),
            'updated_at' => null
        ]);

        $userVentas = User::create([   
            'name' => 'Carlos',
            'last_name' => 'Gonzalez',
            'email' => 'ventas@gmail.com',
            'phone' => '323-333-3333',
            'location' => 'gdl',
            'about' => 'vendedor',
            'status' => 0,
            'password' => ('123456789'),
            'created_at' => now(),
            'updated_at' => null
        ]);


        //Asignamos roles a cada usuario
        $userMaster->assignRole('Master');
        $userAdmin->assignRole('Administrador');
        $userVentas->assignRole('Vendedor');

    }
}
