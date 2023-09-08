<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Fer',
                'email' => 'fernandonina611@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('password'),
                'rol_id' => '1',
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'cliente',
                'email' => 'cliente@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('password'),
                'rol_id' => '2',
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'Operador',
                'email' => 'operador@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('password'),
                'rol_id' => '3',
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('password'),
                'rol_id' => '1',
                'estado' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
