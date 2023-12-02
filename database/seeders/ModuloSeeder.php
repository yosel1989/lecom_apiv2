<?php

namespace Database\Seeders;

use App\Models\V2\Modulo;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modulo::truncate();

        Modulo::create([
            'nombre' => 'Administración',
            'codigo' => 'M0001'
        ]);
        Modulo::create([
            'nombre' => 'Boletaje Interprovincial',
            'codigo' => 'M0002'
        ]);
        Modulo::create([
            'nombre' => 'Contabilidad',
            'codigo' => 'M0003'
        ]);
    }
}
