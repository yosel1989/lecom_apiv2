<?php

namespace Database\Seeders;

use App\Enums\EnumEstadoLiquidacion;
use App\Models\V2\EgresoMotivo;
use App\Models\V2\LiquidacionMotivo;
use Illuminate\Database\Seeder;

class EgresoMotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EgresoMotivo::truncate();

        EgresoMotivo::create([
            'nombre' => 'Error del sistema',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
        EgresoMotivo::create([
            'nombre' => 'Detalle con fecha erronea',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
        EgresoMotivo::create([
            'nombre' => 'Detalle con importe erroneo',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
        EgresoMotivo::create([
            'nombre' => 'Detalle con tipo de egreso erroneo',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
        EgresoMotivo::create([
            'nombre' => 'Caja seleccionada incorrecta',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
        EgresoMotivo::create([
            'nombre' => 'Entidad seleccionada incorrecta',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
        EgresoMotivo::create([
            'nombre' => 'Datos para el comprobante incorrectos',
            'id_estado' => EnumEstadoLiquidacion::Anulado->value,
        ]);
    }
}
