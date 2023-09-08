<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlmacenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('almacenes')->insert([
            [
                'nombre' => 'Almacen La Paz',
                'direccion' => 'Calle Murillo Nº 328',
                'tipo' => 'Almacen',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'nombre' => 'Almacen El Alto',
                'direccion' => 'Calle Enrique Viaña Nº213',
                'tipo' => 'Almacen',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'nombre' => 'Tienda Ofibol',
                'direccion' => 'Calle Murillo Nº127',
                'tipo' => 'Punto de Venta',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], 
        ]);
    }
}
