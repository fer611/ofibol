<?php

namespace Database\Seeders;

use App\Models\Denominacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DenominacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Denominacion::create([
            'tipo' => 'BILLETE',
            'valor' => 200,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'BILLETE',
            'valor' => 100,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'BILLETE',
            'valor' => 50,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'BILLETE',
            'valor' => 20,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'BILLETE',
            'valor' => 10,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Denominacion::create([
            'tipo' => 'MONEDA',
            'valor' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'MONEDA',
            'valor' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'MONEDA',
            'valor' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'MONEDA',
            'valor' => 0.5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'MONEDA',
            'valor' => 0.2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'MONEDA',
            'valor' => 0.1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Denominacion::create([
            'tipo' => 'OTRO',
            'valor' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
