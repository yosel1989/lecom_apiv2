<?php

namespace Database\Seeders;

use App\Models\V2\MotivoTraslado;
use Illuminate\Database\Seeder;

class MotivoTrasladoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MotivoTraslado::truncate();

        MotivoTraslado::create([
            'nombre' => 'Vehiculo averiado',
            'id_estado' => 1
        ]);
        MotivoTraslado::create([
            'nombre' => 'Policia de Tránsito',
            'id_estado' => 1
        ]);
    }
}
