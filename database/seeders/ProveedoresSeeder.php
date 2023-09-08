<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proveedores')->insert([
            [
                'nombre' => 'Madepa',
                'representante' => 'Jose',
                'telefono' => '7852471',
                'direccion' => 'Zona Sur',
                'correo' => null,
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Acricolor',
                'representante' => 'Representante',
                'telefono' => '75532271',
                'direccion' => 'Miraflores',
                'correo' => 'acri@gmail.com',
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Savin',
                'representante' => 'Rep Savin',
                'telefono' => '72542120',
                'direccion' => 'Zona Central',
                'correo' => null,
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Proveedor',
                'representante' => 'proveedor',
                'telefono' => '75270998',
                'direccion' => 'Sopocachi',
                'correo' => null,
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'nuevo',
                'representante' => 'nuevo',
                'telefono' => '75222371',
                'direccion' => 'Miraflores',
                'correo' => null,
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
