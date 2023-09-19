<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * En construccion....
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'categoria_id' => '1',
                'nombre' => 'Papel bond',
                'descripcion' => 'Papel bond tamaño carta paquete de 500 hojas',
                'unidad_medida' => 'paquete',
                'cantidad_unidad' => '1',
                'costo actual' => '5',
                '' => '',
                '' => '',
                '' => '',
                '' => '',
                '' => '',
                '' => '',
                '' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
