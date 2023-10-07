<?php

namespace Database\Seeders;

use App\Enums\EnumParametroConfiguracion;
use Illuminate\Database\Seeder;

class ClienteConfiguracionNorteChicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\V2\ClienteConfiguracion::truncate();

        \App\Models\V2\ClienteConfiguracion::create([
            'id_parametro_configuracion' => EnumParametroConfiguracion::NumeroComprobantesDiarios,
            'id_cliente' => "499d4327-7eac-496c-9b24-6d063e281ba4",
            'valor' => "20",
        ]);
        \App\Models\V2\ClienteConfiguracion::create([
            'id_parametro_configuracion' => EnumParametroConfiguracion::Empresa_Ruc,
            'id_cliente' => "499d4327-7eac-496c-9b24-6d063e281ba4",
            'valor' => "20605180117",
        ]);
        \App\Models\V2\ClienteConfiguracion::create([
            'id_parametro_configuracion' => EnumParametroConfiguracion::Empresa_RazonSocial,
            'id_cliente' => "499d4327-7eac-496c-9b24-6d063e281ba4",
            'valor' => "EMPRESA DE TRANSPORTES NORTE CHICO BARRANCA S.A.C.",
        ]);
        \App\Models\V2\ClienteConfiguracion::create([
            'id_parametro_configuracion' => EnumParametroConfiguracion::Empresa_DireccionFiscal,
            'id_cliente' => "499d4327-7eac-496c-9b24-6d063e281ba4",
            'valor' => "CAL.LIMONCLLO - ZONAL SUPE NRO. 1292 (ALT. DE LA ANTIGUA PANAMERICANA NORTE) LIMA - BARRANCA - BARRANCA",
        ]);
        \App\Models\V2\ClienteConfiguracion::create([
            'id_parametro_configuracion' => EnumParametroConfiguracion::Empresa_Ubigeo,
            'id_cliente' => "499d4327-7eac-496c-9b24-6d063e281ba4",
            'valor' => "150201",
        ]);

    }
}
