<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         //Creación de permisos
         Permission::create(['name' => 'roles']);

         Permission::create(['name' => 'reportes']);
 
         Permission::create(['name' => 'usuarios']);
 
         Permission::create(['name' => 'logs']);
 
         Permission::create(['name' => 'perfil']);
 
         Permission::create(['name' => 'productos']);
 
         Permission::create(['name' => 'consulta']);
 
         Permission::create(['name' => 'ventas']);

         //Asignación de permisios a cada rol
         $roleMaste = Role::create(['name' => 'Master']);
         $roleMaste->givePermissionTo(Permission::all());


         $roleAdmin = Role::create(['name' => 'Administrador'])
         ->givePermissionTo(['reportes', 'usuarios','logs','perfil','productos','consulta','ventas']);

         $roleVendedor = Role::create(['name' => 'Vendedor'])
         ->givePermissionTo(['consulta','ventas']);

    }
}
