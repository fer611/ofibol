<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $this->call([
                RolesSeeder::class,
                CategoriasSeeder::class,
                UsuariosSeeder::class,
                MarcasSeeder::class,
                OrigenesSeeder::class,
                AlmacenesSeeder::class,
            ]);
            User::factory(80)->create();
    }
}
