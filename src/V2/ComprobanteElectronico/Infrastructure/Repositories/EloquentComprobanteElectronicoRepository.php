<?php

declare(strict_types=1);

namespace Src\V2\ComprobanteElectronico\Infrastructure\Repositories;

use App\Enums\EnumCeRazon;
use App\Enums\EnumSunatTipoIgv;
use App\Enums\EnumSunatTransaccion;
use App\Enums\EnumTipoComprobante;
use App\Enums\EnumTipoMoneda;
use App\Enums\EnumUnidadMedida;
use App\Models\V2\ComprobanteElectronico as EloquentModelComprobanteElectronico;
use App\Models\V2\ComprobanteElectronicoItem as EloquentModelComprobanteElectronicoItem;
use App\Models\V2\ComprobanteSerie;
use App\Models\V2\Empresa;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Domain\Contracts\ComprobanteElectronicoRepositoryContract;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\ComprobanteElectronicoItem\Domain\ComprobanteElectronicoItem;
use Src\V2\ComprobanteElectronicoItem\Domain\ComprobanteElectronicoItemList;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\EgresoDetalle\Domain\EgresoDetalle;

final class EloquentComprobanteElectronicoRepository implements ComprobanteElectronicoRepositoryContract
{
    private EloquentModelComprobanteElectronico $eloquentModel;
    private EloquentModelComprobanteElectronicoItem $eloquentModelItem;

    public function __construct()
    {
        $this->eloquentModel = new EloquentModelComprobanteElectronico;
        $this->eloquentModelItem = new EloquentModelComprobanteElectronicoItem;
    }

    public function createToBoleto(
        NumericInteger $idTipoDocumento,
        ValueBoolean $editarEntidad,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Id $idUsuario,
        BoletoInterprovincialOficial $boleto
    ): ComprobanteElectronico
    {
        $idComprobante = Uuid::uuid4();

        // Validar Empresa
        $Empresa = Empresa::findOrFail( $boleto->getIdEmpresa()->value());

        $Serie = ComprobanteSerie::where('id_cliente', $boleto->getIdCliente()->value())
            ->where('id_sede', $boleto->getIdSede()->value())
            ->where('id_tipo_comprobante', $boleto->getIdTipoComprobante()->value())
            ->where('id_empresa', $boleto->getIdEmpresa()->value())
            ->where('id_estado', 1);

        if($Serie->count() === 0){
            throw new \InvalidArgumentException('Falta registrar la serie para esta operación');
        }
        if($Serie->count() > 1){
            throw new \InvalidArgumentException('Existe más de una serie para esta operación');
        }

        $ultimoNumero = $this->eloquentModel->select(DB::raw('MAX(numero) as ultimo_numero'))
            ->where('id_cliente', $boleto->getIdCliente()->value())
            ->where('id_tipo_comprobante', $boleto->getIdTipoComprobante()->value())
            ->where('serie', $Serie->first()->nombre)
            ->first();

        $this->eloquentModel->create([
            'id' =>  $idComprobante,
            'id_cliente' =>  $boleto->getIdCliente()->value(),
            'id_sede' =>  $boleto->getIdSede()->value(),

            'id_tipo_comprobante' =>  $boleto->getIdTipoComprobante()->value(),
            'serie' =>  $Serie->first()->nombre,
            'numero' =>  $ultimoNumero->ultimo_numero ? ($ultimoNumero->ultimo_numero + 1) : 1,
            'id_sunat_transaccion' =>  EnumSunatTransaccion::VentaInterna,


            //  $table->uuid('idClienteSunat')->nullable();
            'id_tipo_documento_entidad' => !$editarEntidad->value() ? $boleto->getIdTipoComprobante()->value() : $idTipoDocumento->value(),
            'numero_documento_entidad' =>  !$editarEntidad->value() ? $boleto->getNumeroDocumento()->value() : $numeroDocumento->value(),
            'nombre_entidad' =>  !$editarEntidad->value() ? $boleto->getNombres()->value() . ' ' . $boleto->getApellidos()->value() : $nombre->value(),
            'direccion_entidad' =>  $direccion->value(),
            'email' =>  null,
            'email1' =>  null,
            'email2' =>  null,

            'f_emision' =>  (new \DateTime('now'))->format('Y-m-d H:i:s'),
            'f_vencimiento' =>  (new \DateTime('now'))->format('Y-m-d H:i:s'),

            'id_moneda' =>  EnumTipoMoneda::Soles,
            'tipo_cambio' =>  0.0,
            'porcentaje_igv' =>  18,
            'descuento_global' =>  0.0,
            'to_descuento' =>  0.0,
            'to_anticipo' =>  0.0,
            'to_gravada' =>  0.0,
            'to_inafecta' =>  0.0,
            'to_exonerada' =>  0.0,
            'to_igv' =>  0.0,
            'to_gratuita' =>  0.0,
            'to_otros' =>  0.0,
            'to_isc' =>  0.0,
            'total' =>  $boleto->getPrecio()->value(),

            'id_percepcion_tipo' =>  null,
            'percepcion_base_imponible' =>  0.0,
            'to_percepcion' =>  0.0,
            'to_incluido_percepcion' =>  0.0,

            'id_retencion_tipo' =>  null,
            'retencion_base_imponible' =>  0.0,
            'to_retencion' =>  0.0,

            'to_imp_bolsa' =>  0.0,
            'observaciones' =>  null,

            'id_tipo_comprobante_modif' =>  null,
            'serie_comprobante_modif' =>  null,
            'numero_comprobante_modif' =>  null,

            'id_tipo_nota_credito' =>  null,
            'id_tipo_nota_debito' =>  null,

            'bl_enviar_sunat' =>  true,
            'bl_enviar_cliente' =>  false,

            'condiciones_pago' =>  null,
            'medio_pago' =>  null,

            'placa_vehiculo' =>  null,
            'order_compra_servicio' =>  null,

            'bl_detraccion' =>  false,
            'id_detraccion' =>  null,

            'formato_de_pdf' =>  'TICKET',

            'contingencia' =>  false,
            'bienes_region_selva' =>  false,
            'serv_region_selva' =>  false,

            'id_razon' =>  EnumCeRazon::VentaBoletoInterprovincial,
            'id_producto' =>  $boleto->getId()->value(),


            'id_estado' =>  1,
            'id_usu_registro' =>  $idUsuario->value(),
            'id_usu_modifico' =>  null,
            'f_registro' =>  (new \DateTime('now'))->format('Y-m-d H:i:s'),
            'f_modifico' =>  null,

            'id_empresa' => $Empresa->id
        ]);

        $model = $this->eloquentModel->find($idComprobante);
        return new ComprobanteElectronico(
            new Id($model->id, false, 'El id del comprobante no tiene el formato correcto'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante->value),
            new Text($model->serie, false, 4, 'La serie excede los 4 caracteres'),
            new NumericInteger($model->numero),
            new NumericInteger($model->id_sunat_transaccion),

            new NumericInteger($model->id_tipo_documento_entidad),
            new Text($model->numero_documento_entidad, false, 15, 'El numero de documento de la entidad excede los 15 caracteres'),
            new Text($model->nombre_entidad, false, 100, 'El nombre de la entidad de documento excede los 100 caracteres'),
            new Text($model->direccion_entidad, true, -1, ''),
            new Text($model->email, true , -1, ''),
            new Text($model->email1, true , -1, ''),
            new Text($model->email2, true , -1, ''),

            new DateFormat($model->f_emision, true, ''),
            new DateFormat($model->f_vencimiento, true, ''),

            new NumericInteger($model->id_moneda),
            new NumericFloat($model->tipo_cambio),
            new NumericFloat($model->porcentaje_igv),
            new NumericFloat($model->descuento_global),
            new NumericFloat($model->to_descuento),
            new NumericFloat($model->to_anticipo),
            new NumericFloat($model->to_gravada),
            new NumericFloat($model->to_inafecta),
            new NumericFloat($model->to_exonerada),
            new NumericFloat($model->to_igv),
            new NumericFloat($model->to_gratuita),
            new NumericFloat($model->to_otros),
            new NumericFloat($model->to_isc),
            new NumericFloat($model->total),

            new NumericInteger($model->id_percepcion_tipo),
            new NumericFloat($model->percepcion_base_imponible),
            new NumericFloat($model->to_percepcion),
            new NumericFloat($model->to_incluido_percepcion),

            new NumericInteger($model->id_retencion_tipo),
            new NumericFloat($model->retencion_base_imponible),
            new NumericFloat($model->to_retencion),

            new NumericFloat($model->to_imp_bolsa),
            new Text($model->observaciones, true, -1, ''),

            new NumericInteger($model->id_tipo_comprobante_modif),
            new Text($model->serie_comprobante_modif, true,  4, 'La serie a modificar excede los 4 caracteres'),
            new NumericInteger($model->numero_comprobante_modif),

            new NumericInteger($model->id_tipo_nota_credito),
            new NumericInteger($model->id_tipo_nota_debito),

            new ValueBoolean($model->bl_enviar_sunat),
            new ValueBoolean($model->bl_enviar_cliente),

            new Text($model->condiciones_pago, true, -1 , ''),
            new Text($model->medio_pago, true, -1, ''),

            new Text($model->placa_vehiculo, true, -1, ''),
            new Text($model->order_compra_servicio, true, -1, ''),

            new ValueBoolean($model->bl_detraccion),
            new Id($model->id_detraccion, true, 'El id de la detraccion no tiene el formato correcto'),

            new Text($model->formato_de_pdf,  false, -1, ''),

            new ValueBoolean($model->contingencia),
            new ValueBoolean($model->bienes_region_selva),
            new ValueBoolean($model->serv_region_selva),

            new NumericInteger($model->id_razon),
            new Id($model->id_producto, false, 'El id del producto no tiene el formato correcto'),

            new NumericInteger($model->id_estado),
            new Id($model->id_usu_registro, false, 'El id del usuario que registro el comprobante no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico el comprobante no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'La fecha de registro del comprobante no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'La fecha de modificación del comprobante no tiene el formato correcto')
        );

    }


    public function createToEgreso(
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Id $idUsuario,
        Egreso $egreso,
    ): ComprobanteElectronico
    {
        $fechaRegistro =  new \DateTime('now');
        $idComprobante = Uuid::uuid4();

        $Serie = ComprobanteSerie::where('id_cliente', $egreso->getIdCliente()->value())
            ->where('id_sede', $egreso->getIdSede()->value())
            ->where('id_tipo_comprobante', EnumTipoComprobante::TicketEgreso->value)
            ->where('id_estado', 1);

        if($Serie->count() === 0){
            throw new \InvalidArgumentException('Falta registrar la serie para esta operación');
        }
        if($Serie->count() > 1){
            throw new \InvalidArgumentException('Existe más de una serie para esta operación');
        }

        $ultimoNumero = $this->eloquentModel->select(DB::raw('MAX(numero) as ultimo_numero'))
            ->where('id_cliente', $egreso->getIdCliente()->value())
            ->where('serie', $Serie->first()->nombre)
            ->first();

        $this->eloquentModel->create([
            'id' =>  $idComprobante->toString(),
            'id_cliente' =>  $egreso->getIdCliente()->value(),
            'id_sede' =>  $egreso->getIdSede()->value(),

            'id_tipo_comprobante' =>  EnumTipoComprobante::TicketEgreso->value,
            'serie' =>  $Serie->first()->nombre,
            'numero' =>  $ultimoNumero->ultimo_numero ? ($ultimoNumero->ultimo_numero + 1) : 1,
            'id_sunat_transaccion' =>  EnumSunatTransaccion::VentaInterna,


            //  $table->uuid('idClienteSunat')->nullable();
            'id_tipo_documento_entidad' => $idTipoDocumento->value(),
            'numero_documento_entidad' => $numeroDocumento->value(),
            'nombre_entidad' => $nombre->value(),
            'direccion_entidad' =>  $direccion->value(),
            'email' =>  null,
            'email1' =>  null,
            'email2' =>  null,

            'f_emision' =>  (new \DateTime('now'))->format('Y-m-d H:i:s'),
            'f_vencimiento' =>  (new \DateTime('now'))->format('Y-m-d H:i:s'),

            'id_moneda' =>  EnumTipoMoneda::Soles,
            'tipo_cambio' =>  0.0,
            'porcentaje_igv' =>  18,
            'descuento_global' =>  0.0,
            'to_descuento' =>  0.0,
            'to_anticipo' =>  0.0,
            'to_gravada' =>  0.0,
            'to_inafecta' =>  0.0,
            'to_exonerada' =>  0.0,
            'to_igv' =>  0.0,
            'to_gratuita' =>  0.0,
            'to_otros' =>  0.0,
            'to_isc' =>  0.0,
            'total' =>  $egreso->getTotal()->value(),

            'id_percepcion_tipo' =>  null,
            'percepcion_base_imponible' =>  0.0,
            'to_percepcion' =>  0.0,
            'to_incluido_percepcion' =>  0.0,

            'id_retencion_tipo' =>  null,
            'retencion_base_imponible' =>  0.0,
            'to_retencion' =>  0.0,

            'to_imp_bolsa' =>  0.0,
            'observaciones' =>  null,

            'id_tipo_comprobante_modif' =>  null,
            'serie_comprobante_modif' =>  null,
            'numero_comprobante_modif' =>  null,

            'id_tipo_nota_credito' =>  null,
            'id_tipo_nota_debito' =>  null,

            'bl_enviar_sunat' =>  true,
            'bl_enviar_cliente' =>  false,

            'condiciones_pago' =>  null,
            'medio_pago' =>  null,

            'placa_vehiculo' =>  null,
            'order_compra_servicio' =>  null,

            'bl_detraccion' =>  false,
            'id_detraccion' =>  null,

            'formato_de_pdf' =>  'TICKET',

            'contingencia' =>  false,
            'bienes_region_selva' =>  false,
            'serv_region_selva' =>  false,

            'id_razon' =>  EnumCeRazon::Egreso,
            'id_producto' =>  $egreso->getId()->value(),


            'id_estado' =>  1,
            'id_usu_registro' =>  $idUsuario->value(),
            'id_usu_modifico' =>  null,
            'f_registro' =>  ($fechaRegistro)->format('Y-m-d H:i:s'),
            'f_modifico' =>  null,
        ]);

        foreach ( $egreso->getDetalle()->all() as $item) {
            $this->eloquentModelItem->create([
                'id_comprobante' => $idComprobante->toString(),
                'id_cliente' => $egreso->getIdCliente()->value(),

                'id_unidad_medida' => EnumUnidadMedida::Servicio,
                'codigo' => $item->getId()->value(),
                'descripcion' => $item->getEgresoTipo()->value(),
                'cantidad' => 1,
                'valor_unitario' => $item->getImporte()->value(),
                'precio_unitario' => $item->getImporte()->value(),
                'descuento' => 0,
                'sub_total' => $item->getImporte()->value(),
                'id_tipo_igv' => EnumSunatTipoIgv::ExoneradoTransferenciaGratuita,
                'id_tipo_ivap' => null,
                'igv' => 0,
                'impBolsa' => 0,
                'total' => $item->getImporte()->value(),

                'anticipo_regulariza' => false,
                'anticipo_comprobante_serie' => null,
                'anticipo_comprobante_numero' => null,

                'codigo_producto_sunat' => null,
                'tipo_isc' => 0,
                'isc' => 0,


                'id_usu_registro' => $idUsuario->value(),
                'id_usu_modifico' => null,
                'f_registro' => ($fechaRegistro)->format('Y-m-d H:i:s'),
                'f_modifico' => null
            ]);
        }

        $model = $this->eloquentModel->find($idComprobante);
        $OModel = new ComprobanteElectronico(
            new Id($model->id, false, 'El id del comprobante no tiene el formato correcto'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante->value),
            new Text($model->serie, false, 4, 'La serie excede los 4 caracteres'),
            new NumericInteger($model->numero),
            new NumericInteger($model->id_sunat_transaccion),

            new NumericInteger($model->id_tipo_documento_entidad),
            new Text($model->numero_documento_entidad, false, 15, 'El numero de documento de la entidad excede los 15 caracteres'),
            new Text($model->nombre_entidad, false, 100, 'El nombre de la entidad de documento excede los 100 caracteres'),
            new Text($model->direccion_entidad, true, -1, ''),
            new Text($model->email, true , -1, ''),
            new Text($model->email1, true , -1, ''),
            new Text($model->email2, true , -1, ''),

            new DateFormat($model->f_emision, true, ''),
            new DateFormat($model->f_vencimiento, true, ''),

            new NumericInteger($model->id_moneda),
            new NumericFloat($model->tipo_cambio),
            new NumericFloat($model->porcentaje_igv),
            new NumericFloat($model->descuento_global),
            new NumericFloat($model->to_descuento),
            new NumericFloat($model->to_anticipo),
            new NumericFloat($model->to_gravada),
            new NumericFloat($model->to_inafecta),
            new NumericFloat($model->to_exonerada),
            new NumericFloat($model->to_igv),
            new NumericFloat($model->to_gratuita),
            new NumericFloat($model->to_otros),
            new NumericFloat($model->to_isc),
            new NumericFloat($model->total),

            new NumericInteger($model->id_percepcion_tipo),
            new NumericFloat($model->percepcion_base_imponible),
            new NumericFloat($model->to_percepcion),
            new NumericFloat($model->to_incluido_percepcion),

            new NumericInteger($model->id_retencion_tipo),
            new NumericFloat($model->retencion_base_imponible),
            new NumericFloat($model->to_retencion),

            new NumericFloat($model->to_imp_bolsa),
            new Text($model->observaciones, true, -1, ''),

            new NumericInteger($model->id_tipo_comprobante_modif),
            new Text($model->serie_comprobante_modif, true,  4, 'La serie a modificar excede los 4 caracteres'),
            new NumericInteger($model->numero_comprobante_modif),

            new NumericInteger($model->id_tipo_nota_credito),
            new NumericInteger($model->id_tipo_nota_debito),

            new ValueBoolean($model->bl_enviar_sunat),
            new ValueBoolean($model->bl_enviar_cliente),

            new Text($model->condiciones_pago, true, -1 , ''),
            new Text($model->medio_pago, true, -1, ''),

            new Text($model->placa_vehiculo, true, -1, ''),
            new Text($model->order_compra_servicio, true, -1, ''),

            new ValueBoolean($model->bl_detraccion),
            new Id($model->id_detraccion, true, 'El id de la detraccion no tiene el formato correcto'),

            new Text($model->formato_de_pdf,  false, -1, ''),

            new ValueBoolean($model->contingencia),
            new ValueBoolean($model->bienes_region_selva),
            new ValueBoolean($model->serv_region_selva),

            new NumericInteger($model->id_razon),
            new Id($model->id_producto, false, 'El id del producto no tiene el formato correcto'),

            new NumericInteger($model->id_estado),
            new Id($model->id_usu_registro, false, 'El id del usuario que registro el comprobante no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico el comprobante no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'La fecha de registro del comprobante no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'La fecha de modificación del comprobante no tiene el formato correcto')
        );
        $OModel->setItems(new ComprobanteElectronicoItemList());


        $items = $this->eloquentModelItem->where('id_comprobante', $idComprobante)->get();
        foreach ( $items as $item) {
            $OModelItem = new ComprobanteElectronicoItem(
                new Id($item->id, false, 'El id del item no tiene el formato correcto'),
                    new Id($item->id_comprobante, false, 'El id del comprobante no tiene el formato correcto'),
                    new Id($item->id_cliente, false,  'El id del cliente no tiene el formato correcto'),
                    new NumericInteger($item->id_unidad_medida->value),
                    new Id($item->codigo, false, 'El id del código del item no tiene el formato correcto'),
                    new Text($item->descripcion, false, -1, ''),
                    new NumericFloat($item->cantidad),
                    new NumericFloat($item->valor_unitario),
                    new NumericFloat($item->precio_unitario),
                    new NumericFloat($item->descuento),
                    new NumericFloat($item->sub_total),
                    new NumericInteger($item->id_tipo_igv),
                    new NumericInteger($item->id_tipo_ivap),
                    new NumericFloat($item->igv),
                    new NumericFloat($item->imp_bolsa),
                    new NumericFloat($item->total),
                    new ValueBoolean($item->anticipo_regulariza ? $item->anticipo_regulariza : false),
                    new Text($item->anticipo_comprobante_serie, false, -1, ''),
                    new Text($item->anticipo_comprobante_numero, false, -1, ''),
                    new Text($item->codigo_producto_sunat, false, -1, ''),
                    new NumericFloat($item->tipo_isc),
                    new NumericFloat($item->isc),
                    new Id($item->id_usu_registro, false,  'El id del usuario que registro no tiene el formato correcto'),
                    new Id($item->id_usu_modifico, true,  'El id del usuario que modifico no tiene el formato correcto'),
                    new DateTimeFormat($item->f_registro, false,  'La fecha de registro no tiene el formato correcto'),
                    new DateTimeFormat($item->f_modifico, true,  'La fecha de modificación no tiene el formato correcto')
            );
            $OModel->getItems()->add($OModelItem);
        }

        return $OModel;
    }
}
