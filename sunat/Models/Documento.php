<?php

namespace Sunat\Models;

use Sunat\Enums\TipoDocumento;
use Sunat\Enums\TipoMoneda;
use Sunat\Enums\TipoOperacion;

class Documento
{
    private string $serie;
    private int $numero;
    private string $fecha_emision;
    private string $hora_emision;
    private string $fecha_vencimiento;
    private TipoDocumento $tipo_comprobante;
    private TipoMoneda $tipo_moneda;
    private TipoOperacion $tipo_transaccion;
    private int $numero_items;
    private string $tipo_pago;


    public function __construct()
    {

    }
}
