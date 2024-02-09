<?php

namespace Database\Seeders;

use App\Enums\EnumEstadoLiquidacion;
use App\Models\V2\LiquidacionMotivo;
use Illuminate\Database\Seeder;

class LiquidacionMotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LiquidacionMotivo::truncate();

        LiquidacionMotivo::create([
            'nombre' => 'Error del sistema',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
        LiquidacionMotivo::create([
            'nombre' => 'Selección incorrecta de fechas',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
    }
}
