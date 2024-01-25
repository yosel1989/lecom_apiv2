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
            'codigo' => 'M0001',
            'icono' => 'https://api.lecomperu.com/assets/img/icons/modulo-administracion.png'
        ]);
        Modulo::create([
            'nombre' => 'Boletaje Interprovincial',
            'codigo' => 'M0002',
            'icono' => 'https://api.lecomperu.com/assets/img/icons/modulo-boletaje-interprovincial.png'
        ]);
        Modulo::create([
            'nombre' => 'Contabilidad',
            'codigo' => 'M0003',
            'icono' => 'https://api.lecomperu.com/assets/img/icons/modulo-contabilidad.png'
        ]);
        Modulo::create([
            'nombre' => 'Reportes',
            'codigo' => 'M0004',
            'icono' => 'https://api.lecomperu.com/assets/img/icons/modulo-reportes.png'
        ]);
        Modulo::create([
            'nombre' => 'Operaciones',
            'codigo' => 'M0005',
            'icono' => 'https://api.lecomperu.com/assets/img/icons/modulo-operaciones.png'
        ]);
    }
}
