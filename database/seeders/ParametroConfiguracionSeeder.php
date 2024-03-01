<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParametroConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\V2\ParametroConfiguracion::truncate();

        \App\Models\V2\ParametroConfiguracion::create([
            'nombre'=> 'Número comprobantes diarios',
            'descripcion'=> 'Número de comprobantes que se podran generar diariamente del total de boletos en el POS.',
        ]);

        \App\Models\V2\ParametroConfiguracion::create([
            'nombre'=> 'RUC',
            'descripcion'=> 'Número de ruc de la entidad',
        ]);

        \App\Models\V2\ParametroConfiguracion::create([
            'nombre'=> 'Razón Social',
            'descripcion'=> 'Nombre con que una entidad o sociedad mercantil está registrada legalmente.',
        ]);

        \App\Models\V2\ParametroConfiguracion::create([
            'nombre'=> 'Dirección fiscal',
            'descripcion'=> 'Dirección legal de la entidad',
        ]);

        \App\Models\V2\ParametroConfiguracion::create([
            'nombre'=> 'Ubigeo',
            'descripcion'=> 'Código que indica la ubicación geográfica de la entidad',
        ]);

        \App\Models\V2\ParametroConfiguracion::create([
            'nombre'=> 'Logo Empresa',
            'descripcion'=> 'Logo de la empresa',
        ]);
    }
}
