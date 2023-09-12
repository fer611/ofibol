<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Cliente']);
        $role3 = Role::create(['name' => 'Operador']);

        

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => 'productos.index'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'productos.destroy'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => 'usuarios.index'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'usuarios.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.destroy'])->syncRoles([$role1]); 

        Permission::create(['name' => 'proveedores.index'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'proveedores.create'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'proveedores.edit'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'proveedores.destroy'])->syncRoles([$role1,$role3]);
        
        Permission::create(['name' => 'categorias.index'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'categorias.create'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'categorias.edit'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'categorias.destroy'])->syncRoles([$role1,$role3]);
 
    }
}
