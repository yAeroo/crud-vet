<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('especie_catalogs')->insert([
            [
                'nombre' => 'Perro',
            ],
            [
                'nombre' => 'Gato',
            ],
            [
                'nombre' => 'Conejo',
            ],
            [
                'nombre' => 'Pez',
            ],
            [
                'nombre' => 'Ave',
            ],
        ]);
    }
}
