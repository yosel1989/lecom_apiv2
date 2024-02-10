<?php
declare(strict_types=1);

namespace Src\V2\ComprobanteElectronicoItem\Domain;

use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class ComprobanteElectronicoItem
{

    private Id $id;
    private Id $idComprobante;
    private Id $idCliente;
    private NumericInteger $idUnidadMedida;
    private Id $codigo;
    private Text $descripcion;
    private NumericFloat $cantidad;
    private NumericFloat $valorUnitario;
    private NumericFloat $precioUnitario;
    private NumericFloat $descuento;
    private NumericFloat $subTotal;
    private NumericInteger $idTipoIgv;
    private NumericInteger $idTipoIvap;
    private NumericFloat $igv;
    private NumericFloat $impBolsa;
    private NumericFloat $total;
    private ValueBoolean $anticipoRegulariza;
    private Text $anticipoComprobanteSerie;
    private Text $anticipoComprobanteNumero;
    private Text $codigoProductoSunat;
    private NumericFloat $tipoIsc;
    private NumericFloat $isc;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    /**
     * @param Id $id
     * @param Id $idComprobante
     * @param Id $idCliente
     * @param NumericInteger $idUnidadMedida
     * @param Id $codigo
     * @param Text $descripcion
     * @param NumericFloat $cantidad
     * @param NumericFloat $valorUnitario
     * @param NumericFloat $precioUnitario
     * @param NumericFloat $descuento
     * @param NumericFloat $subTotal
     * @param NumericInteger $idTipoIgv
     * @param NumericInteger $idTipoIvap
     * @param NumericFloat $igv
     * @param NumericFloat $impBolsa
     * @param NumericFloat $total
     * @param ValueBoolean $anticipoRegulariza
     * @param Text $anticipoComprobanteSerie
     * @param Text $anticipoComprobanteNumero
     * @param Text $codigoProductoSunat
     * @param NumericFloat $tipoIsc
     * @param NumericFloat $isc
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idComprobante,
        Id $idCliente,
        NumericInteger $idUnidadMedida,
        Id $codigo,
        Text $descripcion,
        NumericFloat $cantidad,
        NumericFloat $valorUnitario,
        NumericFloat $precioUnitario,
        NumericFloat $descuento,
        NumericFloat $subTotal,
        NumericInteger $idTipoIgv,
        NumericInteger $idTipoIvap,
        NumericFloat $igv,
        NumericFloat $impBolsa,
        NumericFloat $total,
        ValueBoolean $anticipoRegulariza,
        Text $anticipoComprobanteSerie,
        Text $anticipoComprobanteNumero,
        Text $codigoProductoSunat,
        NumericFloat $tipoIsc,
        NumericFloat $isc,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {
        $this->id = $id;
        $this->idComprobante = $idComprobante;
        $this->idCliente = $idCliente;
        $this->idUnidadMedida = $idUnidadMedida;
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->valorUnitario = $valorUnitario;
        $this->precioUnitario = $precioUnitario;
        $this->descuento = $descuento;
        $this->subTotal = $subTotal;
        $this->idTipoIgv = $idTipoIgv;
        $this->idTipoIvap = $idTipoIvap;
        $this->igv = $igv;
        $this->impBolsa = $impBolsa;
        $this->total = $total;
        $this->anticipoRegulariza = $anticipoRegulariza;
        $this->anticipoComprobanteSerie = $anticipoComprobanteSerie;
        $this->anticipoComprobanteNumero = $anticipoComprobanteNumero;
        $this->codigoProductoSunat = $codigoProductoSunat;
        $this->tipoIsc = $tipoIsc;
        $this->isc = $isc;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @param Id $id
     */
    public function setId(Id $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Id
     */
    public function getIdComprobante(): Id
    {
        return $this->idComprobante;
    }

    /**
     * @param Id $idComprobante
     */
    public function setIdComprobante(Id $idComprobante): void
    {
        $this->idComprobante = $idComprobante;
    }

    /**
     * @return Id
     */
    public function getIdCliente(): Id
    {
        return $this->idCliente;
    }

    /**
     * @param Id $idCliente
     */
    public function setIdCliente(Id $idCliente): void
    {
        $this->idCliente = $idCliente;
    }

    /**
     * @return NumericInteger
     */
    public function getIdUnidadMedida(): NumericInteger
    {
        return $this->idUnidadMedida;
    }

    /**
     * @param NumericInteger $idUnidadMedida
     */
    public function setIdUnidadMedida(NumericInteger $idUnidadMedida): void
    {
        $this->idUnidadMedida = $idUnidadMedida;
    }

    /**
     * @return Id
     */
    public function getCodigo(): Id
    {
        return $this->codigo;
    }

    /**
     * @param Id $codigo
     */
    public function setCodigo(Id $codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return Text
     */
    public function getDescripcion(): Text
    {
        return $this->descripcion;
    }

    /**
     * @param Text $descripcion
     */
    public function setDescripcion(Text $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return NumericFloat
     */
    public function getCantidad(): NumericFloat
    {
        return $this->cantidad;
    }

    /**
     * @param NumericFloat $cantidad
     */
    public function setCantidad(NumericFloat $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return NumericFloat
     */
    public function getValorUnitario(): NumericFloat
    {
        return $this->valorUnitario;
    }

    /**
     * @param NumericFloat $valorUnitario
     */
    public function setValorUnitario(NumericFloat $valorUnitario): void
    {
        $this->valorUnitario = $valorUnitario;
    }

    /**
     * @return NumericFloat
     */
    public function getPrecioUnitario(): NumericFloat
    {
        return $this->precioUnitario;
    }

    /**
     * @param NumericFloat $precioUnitario
     */
    public function setPrecioUnitario(NumericFloat $precioUnitario): void
    {
        $this->precioUnitario = $precioUnitario;
    }

    /**
     * @return NumericFloat
     */
    public function getDescuento(): NumericFloat
    {
        return $this->descuento;
    }

    /**
     * @param NumericFloat $descuento
     */
    public function setDescuento(NumericFloat $descuento): void
    {
        $this->descuento = $descuento;
    }

    /**
     * @return NumericFloat
     */
    public function getSubTotal(): NumericFloat
    {
        return $this->subTotal;
    }

    /**
     * @param NumericFloat $subTotal
     */
    public function setSubTotal(NumericFloat $subTotal): void
    {
        $this->subTotal = $subTotal;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoIgv(): NumericInteger
    {
        return $this->idTipoIgv;
    }

    /**
     * @param NumericInteger $idTipoIgv
     */
    public function setIdTipoIgv(NumericInteger $idTipoIgv): void
    {
        $this->idTipoIgv = $idTipoIgv;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoIvap(): NumericInteger
    {
        return $this->idTipoIvap;
    }

    /**
     * @param NumericInteger $idTipoIvap
     */
    public function setIdTipoIvap(NumericInteger $idTipoIvap): void
    {
        $this->idTipoIvap = $idTipoIvap;
    }

    /**
     * @return NumericFloat
     */
    public function getIgv(): NumericFloat
    {
        return $this->igv;
    }

    /**
     * @param NumericFloat $igv
     */
    public function setIgv(NumericFloat $igv): void
    {
        $this->igv = $igv;
    }

    /**
     * @return NumericFloat
     */
    public function getImpBolsa(): NumericFloat
    {
        return $this->impBolsa;
    }

    /**
     * @param NumericFloat $impBolsa
     */
    public function setImpBolsa(NumericFloat $impBolsa): void
    {
        $this->impBolsa = $impBolsa;
    }

    /**
     * @return NumericFloat
     */
    public function getTotal(): NumericFloat
    {
        return $this->total;
    }

    /**
     * @param NumericFloat $total
     */
    public function setTotal(NumericFloat $total): void
    {
        $this->total = $total;
    }

    /**
     * @return ValueBoolean
     */
    public function getAnticipoRegulariza(): ValueBoolean
    {
        return $this->anticipoRegulariza;
    }

    /**
     * @param ValueBoolean $anticipoRegulariza
     */
    public function setAnticipoRegulariza(ValueBoolean $anticipoRegulariza): void
    {
        $this->anticipoRegulariza = $anticipoRegulariza;
    }

    /**
     * @return Text
     */
    public function getAnticipoComprobanteSerie(): Text
    {
        return $this->anticipoComprobanteSerie;
    }

    /**
     * @param Text $anticipoComprobanteSerie
     */
    public function setAnticipoComprobanteSerie(Text $anticipoComprobanteSerie): void
    {
        $this->anticipoComprobanteSerie = $anticipoComprobanteSerie;
    }

    /**
     * @return Text
     */
    public function getAnticipoComprobanteNumero(): Text
    {
        return $this->anticipoComprobanteNumero;
    }

    /**
     * @param Text $anticipoComprobanteNumero
     */
    public function setAnticipoComprobanteNumero(Text $anticipoComprobanteNumero): void
    {
        $this->anticipoComprobanteNumero = $anticipoComprobanteNumero;
    }

    /**
     * @return Text
     */
    public function getCodigoProductoSunat(): Text
    {
        return $this->codigoProductoSunat;
    }

    /**
     * @param Text $codigoProductoSunat
     */
    public function setCodigoProductoSunat(Text $codigoProductoSunat): void
    {
        $this->codigoProductoSunat = $codigoProductoSunat;
    }

    /**
     * @return NumericFloat
     */
    public function getTipoIsc(): NumericFloat
    {
        return $this->tipoIsc;
    }

    /**
     * @param NumericFloat $tipoIsc
     */
    public function setTipoIsc(NumericFloat $tipoIsc): void
    {
        $this->tipoIsc = $tipoIsc;
    }

    /**
     * @return NumericFloat
     */
    public function getIsc(): NumericFloat
    {
        return $this->isc;
    }

    /**
     * @param NumericFloat $isc
     */
    public function setIsc(NumericFloat $isc): void
    {
        $this->isc = $isc;
    }

    /**
     * @return Id
     */
    public function getIdUsuarioRegistro(): Id
    {
        return $this->idUsuarioRegistro;
    }

    /**
     * @param Id $idUsuarioRegistro
     */
    public function setIdUsuarioRegistro(Id $idUsuarioRegistro): void
    {
        $this->idUsuarioRegistro = $idUsuarioRegistro;
    }

    /**
     * @return Id
     */
    public function getIdUsuarioModifico(): Id
    {
        return $this->idUsuarioModifico;
    }

    /**
     * @param Id $idUsuarioModifico
     */
    public function setIdUsuarioModifico(Id $idUsuarioModifico): void
    {
        $this->idUsuarioModifico = $idUsuarioModifico;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaRegistro(): DateTimeFormat
    {
        return $this->fechaRegistro;
    }

    /**
     * @param DateTimeFormat $fechaRegistro
     */
    public function setFechaRegistro(DateTimeFormat $fechaRegistro): void
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaModifico(): DateTimeFormat
    {
        return $this->fechaModifico;
    }

    /**
     * @param DateTimeFormat $fechaModifico
     */
    public function setFechaModifico(DateTimeFormat $fechaModifico): void
    {
        $this->fechaModifico = $fechaModifico;
    }


}
