<?php

namespace Database\Seeders;

use App\Models\V2\Accion;
use Illuminate\Database\Seeder;

class AccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Accion::truncate();

        Accion::create([
            'nombre' => 'Boleto Escaneado',
            'entidad' => 'boleto_interprovincial'
        ]);
        Accion::create([
            'nombre' => 'Traspaso de Vehiculo',
            'entidad' => 'boleto_interprovincial'
        ]);
    }
}
