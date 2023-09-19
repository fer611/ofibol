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

        

        Permission::create(['name' => 'dashboard', 'description' => 'Ver el Dashboard'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => 'productos.index', 'description' => 'Ver listado de productos'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'productos.create', 'description' => 'Crear productos'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'productos.edit', 'description' => 'Editar productos'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'productos.destroy', 'description' => 'Eliminar productos'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => 'usuarios.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'usuarios.create', 'description' => 'Crear usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.edit', 'description' => 'Editar usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.destroy', 'description' => 'Eliminar Usuarios'])->syncRoles([$role1]); 

        Permission::create(['name' => 'proveedores.index', 'description' => 'Ver listado de proveedores'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'proveedores.create', 'description' => 'Crear proveedores'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'proveedores.edit', 'description' => 'Editar proveedores'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'proveedores.destroy', 'description' => 'Eliminar proveedores'])->syncRoles([$role1,$role3]);
        
        Permission::create(['name' => 'categorias.index', 'description' => 'Ver listado de categorias'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'categorias.create', 'description' => 'Crear categorias'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'categorias.edit', 'description' => 'Editar categorias'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'categorias.destroy', 'description' => 'Eliminar categorias'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => 'roles.index', 'description' => 'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.create', 'description' => 'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar roles'])->syncRoles([$role1]);
    }
}
