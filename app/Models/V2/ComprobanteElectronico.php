<?php

namespace App\Models\V2;

use App\Enums\EnumRazonComprobante;
use App\Enums\EnumSunatTransaccion;
use App\Enums\EnumTipoComprobante;
use App\Enums\EnumTipoDocumento;
use App\Enums\EnumTipoMoneda;
use App\Enums\EnumTipoPago;
use App\Enums\IdTipoDocumento;
use Illuminate\Database\Eloquent\Model;

class ComprobanteElectronico extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ce_comprobante_electronico";
    public $timestamps = true;

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',

        'idTipoComprobante',
        'serie',
        'numero',
        'idSunatTransaccion',


        'idClienteSunat',
        'idClienteSunatTipoDocumento',
        'clienteSunatNumeroDocumento',
        'clienteSunatNombre',
        'clienteSunatDireccion',
        'clienteEmail',
        'clienteEmail1',
        'clienteEmail2',

        'fechaEmision',
        'fechaVencimiento',

        'idMoneda',
        'tipoCambio',
        'porcentajeIgv',
        'descuentoGlobal',
        'totalDescuento',
        'totalAnticipo',
        'totalGravada',
        'totalInafecta',
        'totalExonerada',
        'totalIgv',
        'totalGratuita',
        'totalOtros',
        'totalIsc',
        'total',

        'idPercepcionTipo',
        'percepcionBaseImponible',
        'totalPercepcion',
        'totalIncluidoPercepcion',

        'idRetencionTipo',
        'retencionBaseImponible',
        'totalRetencion',

        'totalImpBolsa',
        'observaciones',

        'idTipoComprobanteModifica',
        'serieComprobanteModifica',
        'numeroComprobanteModifica',

        'idTipoNotaCredito',
        'idTipoNotaDebito',

        'enviarSunat',
        'enviarCliente',

        'condicionesPago',
        'medioPago',

        'placaVehiculo',
        'ordenCompraServicio',

        'detraccion',
        'idDetraccion',

        'formato_de_pdf',

        'contingencia',
        'bienesRegionSelva',
        'servRegionSelva',

        'idRazon',
        'idProducto',

        'idEstado',
        'idEliminado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'idTipoComprobante' =>  EnumTipoComprobante::class,
        'numero' =>  'integer',
        'idSunatTransaccion' =>  'integer',
        'idClienteSuantTipoDocumento' => 'integer',

        'fechaEmision' => 'string',
        'fechaVencimiento' => 'string',
        'idMoneda' => 'integer',
        'tipoCambio' => 'float',
        'porcentajeIgv' => 'float',
        'descuentoGlobal' => 'float',
        'totalDescuento' => 'float',
        'totalAnticipo' => 'float',
        'totalGravada' => 'float',
        'totalInafecta' => 'float',
        'totalExonerada' => 'float',
        'totalIgv' => 'float',
        'totalGratuita' => 'float',
        'totalOtros' => 'float',
        'totalIsc' => 'float',
        'total' => 'float',
        'idPercepcionTipo' => 'integer',
        'percepcionBaseImponible' => 'float',
        'totalPercepcion' => 'float',
        'totalIncluidoPercepcion' => 'float',
        'idRetencionTipo' => 'integer',
        'retencionBaseImponible' => 'float',
        'totalRetencion' => 'float',
        'totalImpBolsa' => 'float',
        'idTipoComprobanteModifica' => 'integer',
        'numeroComprobanteModifica' => 'integer',
        'idTipoNotaCredito' => 'integer',
        'idTipoNotaDebito' => 'integer',
        'enviarSunat' => 'boolean',
        'enviarCliente' => 'boolean',
        'detraccion' => 'boolean',
        'idDetraccion' => 'integer',
        'contingencia' => 'boolean',
        'bienesRegionSelva' => 'boolean',
        'servRegionSerlva' => 'boolean',
        'idRazon' => 'integer',


        'idEstado' =>  'integer',
        'idEliminado' =>  'integer',
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string'
    ];

}
