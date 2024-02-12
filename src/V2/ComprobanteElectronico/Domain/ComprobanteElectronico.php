<?php
declare(strict_types=1);

namespace Src\V2\ComprobanteElectronico\Domain;

use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ComprobanteElectronicoItem\Domain\ComprobanteElectronicoItemList;

final class ComprobanteElectronico
{
    private Id $id;
    private Id $idCliente;
    private Id $idSede;
    private NumericInteger $idTipoComprobante;
    private Text $serie;
    private NumericInteger $numero;
    private NumericInteger $idSunatTransaccion;
    private NumericInteger $idTipoDocumento;
    private Text $numeroDocumento;
    private Text $nombre;
    private Text $direccion;
    private Text $email;
    private Text $email1;
    private Text $email2;
    private DateFormat $fechaEmision;
    private DateFormat $fechaVencimiento;
    private NumericInteger $idMoneda;
    private NumericFloat $tipoCambio;
    private NumericFloat $porcentajerIgv;
    private NumericFloat $descuentoGlobal;
    private NumericFloat $totalDescuento;
    private NumericFloat $totalAnticipo;
    private NumericFloat $totalGravada;
    private NumericFloat $totalInafecta;
    private NumericFloat $totalExonerada;
    private NumericFloat $totalIgv;
    private NumericFloat $totalGratuita;
    private NumericFloat $totalOtros;
    private NumericFloat $totalIsc;
    private NumericFloat $total;
    private NumericInteger $idPercepcionTipo;
    private NumericFloat $percepcionBaseImponible;
    private NumericFloat $totalPercepcion;
    private NumericFloat $totalIncluidoPercepcion;
    private NumericInteger $idRetencionTipo;
    private NumericFloat $retencionBaseImponible;
    private NumericFloat $totalRetencion;
    private NumericFloat $totalImpuestoBolsa;
    private Text $observaciones;
    private NumericInteger $idTipoComprobanteModifica;
    private Text $serieComprobanteModifica;
    private NumericInteger $numeroComprobanteModifica;
    private NumericInteger $idTipoNotaCredito;
    private NumericInteger $idTipoNotaDebito;
    private ValueBoolean $enviarSunat;
    private ValueBoolean $enviarCliente;
    private Text $condicionesPago;
    private Text $medioPago;
    private Text $placaVehiculo;
    private Text $ordenComproServicio;
    private ValueBoolean $detraccion;
    private Id $idDetraccion;
    private Text $formatoPdf;
    private ValueBoolean $contingencia;
    private ValueBoolean $bienesRegionSelva;
    private ValueBoolean $servicioRegionSelva;
    private NumericInteger $idRazon;
    private Id $idProducto;
    private NumericInteger $idEstado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    // secondary
    private ComprobanteElectronicoItemList $items;

    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idSede
     * @param NumericInteger $idTipoComprobante
     * @param Text $serie
     * @param NumericInteger $numero
     * @param NumericInteger $idSunatTransaccion
     * @param NumericInteger $idTipoDocumento
     * @param Text $numeroDocumento
     * @param Text $nombre
     * @param Text $direccion
     * @param Text $email
     * @param Text $email1
     * @param Text $email2
     * @param DateFormat $fechaEmision
     * @param DateFormat $fechaVencimiento
     * @param NumericInteger $idMoneda
     * @param NumericFloat $tipoCambio
     * @param NumericFloat $porcentajerIgv
     * @param NumericFloat $descuentoGlobal
     * @param NumericFloat $totalDescuento
     * @param NumericFloat $totalAnticipo
     * @param NumericFloat $totalGravada
     * @param NumericFloat $totalInafecta
     * @param NumericFloat $totalExonerada
     * @param NumericFloat $totalIgv
     * @param NumericFloat $totalGratuita
     * @param NumericFloat $totalOtros
     * @param NumericFloat $totalIsc
     * @param NumericFloat $total
     * @param NumericInteger $idPercepcionTipo
     * @param NumericFloat $percepcionBaseImponible
     * @param NumericFloat $totalPercepcion
     * @param NumericFloat $totalIncluidoPercepcion
     * @param NumericInteger $idRetencionTipo
     * @param NumericFloat $retencionBaseImponible
     * @param NumericFloat $totalRetencion
     * @param NumericFloat $totalImpuestoBolsa
     * @param Text $observaciones
     * @param NumericInteger $idTipoComprobanteModifica
     * @param Text $serieComprobanteModifica
     * @param NumericInteger $numeroComprobanteModifica
     * @param NumericInteger $idTipoNotaCredito
     * @param NumericInteger $idTipoNotaDebito
     * @param ValueBoolean $enviarSunat
     * @param ValueBoolean $enviarCliente
     * @param Text $condicionesPago
     * @param Text $medioPago
     * @param Text $placaVehiculo
     * @param Text $ordenComproServicio
     * @param ValueBoolean $detraccion
     * @param Id $idDetraccion
     * @param Text $formatoPdf
     * @param ValueBoolean $contingencia
     * @param ValueBoolean $bienesRegionSelva
     * @param ValueBoolean $servicioRegionSelva
     * @param NumericInteger $idRazon
     * @param Id $idProducto
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoComprobante,
        Text $serie,
        NumericInteger $numero,
        NumericInteger $idSunatTransaccion,

        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Text $email,
        Text $email1,
        Text $email2,

        DateFormat $fechaEmision,
        DateFormat $fechaVencimiento,

        NumericInteger $idMoneda,
        NumericFloat $tipoCambio,
        NumericFloat $porcentajerIgv,
        NumericFloat $descuentoGlobal,
        NumericFloat $totalDescuento,
        NumericFloat $totalAnticipo,
        NumericFloat $totalGravada,
        NumericFloat $totalInafecta,
        NumericFloat $totalExonerada,
        NumericFloat $totalIgv,
        NumericFloat $totalGratuita,
        NumericFloat $totalOtros,
        NumericFloat $totalIsc,
        NumericFloat $total,

        NumericInteger $idPercepcionTipo,
        NumericFloat $percepcionBaseImponible,
        NumericFloat $totalPercepcion,
        NumericFloat $totalIncluidoPercepcion,

        NumericInteger $idRetencionTipo,
        NumericFloat $retencionBaseImponible,
        NumericFloat $totalRetencion,

        NumericFloat $totalImpuestoBolsa,
        Text $observaciones,

        NumericInteger $idTipoComprobanteModifica,
        Text $serieComprobanteModifica,
        NumericInteger $numeroComprobanteModifica,

        NumericInteger $idTipoNotaCredito,
        NumericInteger $idTipoNotaDebito,

        ValueBoolean $enviarSunat,
        ValueBoolean $enviarCliente,

        Text $condicionesPago,
        Text $medioPago,

        Text $placaVehiculo,
        Text $ordenComproServicio,

        ValueBoolean $detraccion,
        Id $idDetraccion,

        Text $formatoPdf,

        ValueBoolean $contingencia,
        ValueBoolean $bienesRegionSelva,
        ValueBoolean $servicioRegionSelva,

        NumericInteger $idRazon,
        Id $idProducto,

        NumericInteger $idEstado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idSede = $idSede;
        $this->idTipoComprobante = $idTipoComprobante;
        $this->serie = $serie;
        $this->numero = $numero;
        $this->idSunatTransaccion = $idSunatTransaccion;
        $this->idTipoDocumento = $idTipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->email1 = $email1;
        $this->email2 = $email2;
        $this->fechaEmision = $fechaEmision;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->idMoneda = $idMoneda;
        $this->tipoCambio = $tipoCambio;
        $this->porcentajerIgv = $porcentajerIgv;
        $this->descuentoGlobal = $descuentoGlobal;
        $this->totalDescuento = $totalDescuento;
        $this->totalAnticipo = $totalAnticipo;
        $this->totalGravada = $totalGravada;
        $this->totalInafecta = $totalInafecta;
        $this->totalExonerada = $totalExonerada;
        $this->totalIgv = $totalIgv;
        $this->totalGratuita = $totalGratuita;
        $this->totalOtros = $totalOtros;
        $this->totalIsc = $totalIsc;
        $this->total = $total;
        $this->idPercepcionTipo = $idPercepcionTipo;
        $this->percepcionBaseImponible = $percepcionBaseImponible;
        $this->totalPercepcion = $totalPercepcion;
        $this->totalIncluidoPercepcion = $totalIncluidoPercepcion;
        $this->idRetencionTipo = $idRetencionTipo;
        $this->retencionBaseImponible = $retencionBaseImponible;
        $this->totalRetencion = $totalRetencion;
        $this->totalImpuestoBolsa = $totalImpuestoBolsa;
        $this->observaciones = $observaciones;
        $this->idTipoComprobanteModifica = $idTipoComprobanteModifica;
        $this->serieComprobanteModifica = $serieComprobanteModifica;
        $this->numeroComprobanteModifica = $numeroComprobanteModifica;
        $this->idTipoNotaCredito = $idTipoNotaCredito;
        $this->idTipoNotaDebito = $idTipoNotaDebito;
        $this->enviarSunat = $enviarSunat;
        $this->enviarCliente = $enviarCliente;
        $this->condicionesPago = $condicionesPago;
        $this->medioPago = $medioPago;
        $this->placaVehiculo = $placaVehiculo;
        $this->ordenComproServicio = $ordenComproServicio;
        $this->detraccion = $detraccion;
        $this->idDetraccion = $idDetraccion;
        $this->formatoPdf = $formatoPdf;
        $this->contingencia = $contingencia;
        $this->bienesRegionSelva = $bienesRegionSelva;
        $this->servicioRegionSelva = $servicioRegionSelva;
        $this->idRazon = $idRazon;
        $this->idProducto = $idProducto;
        $this->idEstado = $idEstado;
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
     * @return Id
     */
    public function getIdSede(): Id
    {
        return $this->idSede;
    }

    /**
     * @param Id $idSede
     */
    public function setIdSede(Id $idSede): void
    {
        $this->idSede = $idSede;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoComprobante(): NumericInteger
    {
        return $this->idTipoComprobante;
    }

    /**
     * @param NumericInteger $idTipoComprobante
     */
    public function setIdTipoComprobante(NumericInteger $idTipoComprobante): void
    {
        $this->idTipoComprobante = $idTipoComprobante;
    }

    /**
     * @return Text
     */
    public function getSerie(): Text
    {
        return $this->serie;
    }

    /**
     * @param Text $serie
     */
    public function setSerie(Text $serie): void
    {
        $this->serie = $serie;
    }

    /**
     * @return NumericInteger
     */
    public function getNumero(): NumericInteger
    {
        return $this->numero;
    }

    /**
     * @param NumericInteger $numero
     */
    public function setNumero(NumericInteger $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return NumericInteger
     */
    public function getIdSunatTransaccion(): NumericInteger
    {
        return $this->idSunatTransaccion;
    }

    /**
     * @param NumericInteger $idSunatTransaccion
     */
    public function setIdSunatTransaccion(NumericInteger $idSunatTransaccion): void
    {
        $this->idSunatTransaccion = $idSunatTransaccion;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoDocumento(): NumericInteger
    {
        return $this->idTipoDocumento;
    }

    /**
     * @param NumericInteger $idTipoDocumento
     */
    public function setIdTipoDocumento(NumericInteger $idTipoDocumento): void
    {
        $this->idTipoDocumento = $idTipoDocumento;
    }

    /**
     * @return Text
     */
    public function getNumeroDocumento(): Text
    {
        return $this->numeroDocumento;
    }

    /**
     * @param Text $numeroDocumento
     */
    public function setNumeroDocumento(Text $numeroDocumento): void
    {
        $this->numeroDocumento = $numeroDocumento;
    }

    /**
     * @return Text
     */
    public function getNombre(): Text
    {
        return $this->nombre;
    }

    /**
     * @param Text $nombre
     */
    public function setNombre(Text $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Text
     */
    public function getDireccion(): Text
    {
        return $this->direccion;
    }

    /**
     * @param Text $direccion
     */
    public function setDireccion(Text $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return Text
     */
    public function getEmail(): Text
    {
        return $this->email;
    }

    /**
     * @param Text $email
     */
    public function setEmail(Text $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Text
     */
    public function getEmail1(): Text
    {
        return $this->email1;
    }

    /**
     * @param Text $email1
     */
    public function setEmail1(Text $email1): void
    {
        $this->email1 = $email1;
    }

    /**
     * @return Text
     */
    public function getEmail2(): Text
    {
        return $this->email2;
    }

    /**
     * @param Text $email2
     */
    public function setEmail2(Text $email2): void
    {
        $this->email2 = $email2;
    }

    /**
     * @return DateFormat
     */
    public function getFechaEmision(): DateFormat
    {
        return $this->fechaEmision;
    }

    /**
     * @param DateFormat $fechaEmision
     */
    public function setFechaEmision(DateFormat $fechaEmision): void
    {
        $this->fechaEmision = $fechaEmision;
    }

    /**
     * @return DateFormat
     */
    public function getFechaVencimiento(): DateFormat
    {
        return $this->fechaVencimiento;
    }

    /**
     * @param DateFormat $fechaVencimiento
     */
    public function setFechaVencimiento(DateFormat $fechaVencimiento): void
    {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    /**
     * @return NumericInteger
     */
    public function getIdMoneda(): NumericInteger
    {
        return $this->idMoneda;
    }

    /**
     * @param NumericInteger $idMoneda
     */
    public function setIdMoneda(NumericInteger $idMoneda): void
    {
        $this->idMoneda = $idMoneda;
    }

    /**
     * @return NumericFloat
     */
    public function getTipoCambio(): NumericFloat
    {
        return $this->tipoCambio;
    }

    /**
     * @param NumericFloat $tipoCambio
     */
    public function setTipoCambio(NumericFloat $tipoCambio): void
    {
        $this->tipoCambio = $tipoCambio;
    }

    /**
     * @return NumericFloat
     */
    public function getPorcentajerIgv(): NumericFloat
    {
        return $this->porcentajerIgv;
    }

    /**
     * @param NumericFloat $porcentajerIgv
     */
    public function setPorcentajerIgv(NumericFloat $porcentajerIgv): void
    {
        $this->porcentajerIgv = $porcentajerIgv;
    }

    /**
     * @return NumericFloat
     */
    public function getDescuentoGlobal(): NumericFloat
    {
        return $this->descuentoGlobal;
    }

    /**
     * @param NumericFloat $descuentoGlobal
     */
    public function setDescuentoGlobal(NumericFloat $descuentoGlobal): void
    {
        $this->descuentoGlobal = $descuentoGlobal;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalDescuento(): NumericFloat
    {
        return $this->totalDescuento;
    }

    /**
     * @param NumericFloat $totalDescuento
     */
    public function setTotalDescuento(NumericFloat $totalDescuento): void
    {
        $this->totalDescuento = $totalDescuento;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalAnticipo(): NumericFloat
    {
        return $this->totalAnticipo;
    }

    /**
     * @param NumericFloat $totalAnticipo
     */
    public function setTotalAnticipo(NumericFloat $totalAnticipo): void
    {
        $this->totalAnticipo = $totalAnticipo;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalGravada(): NumericFloat
    {
        return $this->totalGravada;
    }

    /**
     * @param NumericFloat $totalGravada
     */
    public function setTotalGravada(NumericFloat $totalGravada): void
    {
        $this->totalGravada = $totalGravada;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalInafecta(): NumericFloat
    {
        return $this->totalInafecta;
    }

    /**
     * @param NumericFloat $totalInafecta
     */
    public function setTotalInafecta(NumericFloat $totalInafecta): void
    {
        $this->totalInafecta = $totalInafecta;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalExonerada(): NumericFloat
    {
        return $this->totalExonerada;
    }

    /**
     * @param NumericFloat $totalExonerada
     */
    public function setTotalExonerada(NumericFloat $totalExonerada): void
    {
        $this->totalExonerada = $totalExonerada;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalIgv(): NumericFloat
    {
        return $this->totalIgv;
    }

    /**
     * @param NumericFloat $totalIgv
     */
    public function setTotalIgv(NumericFloat $totalIgv): void
    {
        $this->totalIgv = $totalIgv;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalGratuita(): NumericFloat
    {
        return $this->totalGratuita;
    }

    /**
     * @param NumericFloat $totalGratuita
     */
    public function setTotalGratuita(NumericFloat $totalGratuita): void
    {
        $this->totalGratuita = $totalGratuita;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalOtros(): NumericFloat
    {
        return $this->totalOtros;
    }

    /**
     * @param NumericFloat $totalOtros
     */
    public function setTotalOtros(NumericFloat $totalOtros): void
    {
        $this->totalOtros = $totalOtros;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalIsc(): NumericFloat
    {
        return $this->totalIsc;
    }

    /**
     * @param NumericFloat $totalIsc
     */
    public function setTotalIsc(NumericFloat $totalIsc): void
    {
        $this->totalIsc = $totalIsc;
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
     * @return NumericInteger
     */
    public function getIdPercepcionTipo(): NumericInteger
    {
        return $this->idPercepcionTipo;
    }

    /**
     * @param NumericInteger $idPercepcionTipo
     */
    public function setIdPercepcionTipo(NumericInteger $idPercepcionTipo): void
    {
        $this->idPercepcionTipo = $idPercepcionTipo;
    }

    /**
     * @return NumericFloat
     */
    public function getPercepcionBaseImponible(): NumericFloat
    {
        return $this->percepcionBaseImponible;
    }

    /**
     * @param NumericFloat $percepcionBaseImponible
     */
    public function setPercepcionBaseImponible(NumericFloat $percepcionBaseImponible): void
    {
        $this->percepcionBaseImponible = $percepcionBaseImponible;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalPercepcion(): NumericFloat
    {
        return $this->totalPercepcion;
    }

    /**
     * @param NumericFloat $totalPercepcion
     */
    public function setTotalPercepcion(NumericFloat $totalPercepcion): void
    {
        $this->totalPercepcion = $totalPercepcion;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalIncluidoPercepcion(): NumericFloat
    {
        return $this->totalIncluidoPercepcion;
    }

    /**
     * @param NumericFloat $totalIncluidoPercepcion
     */
    public function setTotalIncluidoPercepcion(NumericFloat $totalIncluidoPercepcion): void
    {
        $this->totalIncluidoPercepcion = $totalIncluidoPercepcion;
    }

    /**
     * @return NumericInteger
     */
    public function getIdRetencionTipo(): NumericInteger
    {
        return $this->idRetencionTipo;
    }

    /**
     * @param NumericInteger $idRetencionTipo
     */
    public function setIdRetencionTipo(NumericInteger $idRetencionTipo): void
    {
        $this->idRetencionTipo = $idRetencionTipo;
    }

    /**
     * @return NumericFloat
     */
    public function getRetencionBaseImponible(): NumericFloat
    {
        return $this->retencionBaseImponible;
    }

    /**
     * @param NumericFloat $retencionBaseImponible
     */
    public function setRetencionBaseImponible(NumericFloat $retencionBaseImponible): void
    {
        $this->retencionBaseImponible = $retencionBaseImponible;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalRetencion(): NumericFloat
    {
        return $this->totalRetencion;
    }

    /**
     * @param NumericFloat $totalRetencion
     */
    public function setTotalRetencion(NumericFloat $totalRetencion): void
    {
        $this->totalRetencion = $totalRetencion;
    }

    /**
     * @return NumericFloat
     */
    public function getTotalImpuestoBolsa(): NumericFloat
    {
        return $this->totalImpuestoBolsa;
    }

    /**
     * @param NumericFloat $totalImpuestoBolsa
     */
    public function setTotalImpuestoBolsa(NumericFloat $totalImpuestoBolsa): void
    {
        $this->totalImpuestoBolsa = $totalImpuestoBolsa;
    }

    /**
     * @return Text
     */
    public function getObservaciones(): Text
    {
        return $this->observaciones;
    }

    /**
     * @param Text $observaciones
     */
    public function setObservaciones(Text $observaciones): void
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoComprobanteModifica(): NumericInteger
    {
        return $this->idTipoComprobanteModifica;
    }

    /**
     * @param NumericInteger $idTipoComprobanteModifica
     */
    public function setIdTipoComprobanteModifica(NumericInteger $idTipoComprobanteModifica): void
    {
        $this->idTipoComprobanteModifica = $idTipoComprobanteModifica;
    }

    /**
     * @return Text
     */
    public function getSerieComprobanteModifica(): Text
    {
        return $this->serieComprobanteModifica;
    }

    /**
     * @param Text $serieComprobanteModifica
     */
    public function setSerieComprobanteModifica(Text $serieComprobanteModifica): void
    {
        $this->serieComprobanteModifica = $serieComprobanteModifica;
    }

    /**
     * @return NumericInteger
     */
    public function getNumeroComprobanteModifica(): NumericInteger
    {
        return $this->numeroComprobanteModifica;
    }

    /**
     * @param NumericInteger $numeroComprobanteModifica
     */
    public function setNumeroComprobanteModifica(NumericInteger $numeroComprobanteModifica): void
    {
        $this->numeroComprobanteModifica = $numeroComprobanteModifica;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoNotaCredito(): NumericInteger
    {
        return $this->idTipoNotaCredito;
    }

    /**
     * @param NumericInteger $idTipoNotaCredito
     */
    public function setIdTipoNotaCredito(NumericInteger $idTipoNotaCredito): void
    {
        $this->idTipoNotaCredito = $idTipoNotaCredito;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoNotaDebito(): NumericInteger
    {
        return $this->idTipoNotaDebito;
    }

    /**
     * @param NumericInteger $idTipoNotaDebito
     */
    public function setIdTipoNotaDebito(NumericInteger $idTipoNotaDebito): void
    {
        $this->idTipoNotaDebito = $idTipoNotaDebito;
    }

    /**
     * @return ValueBoolean
     */
    public function getEnviarSunat(): ValueBoolean
    {
        return $this->enviarSunat;
    }

    /**
     * @param ValueBoolean $enviarSunat
     */
    public function setEnviarSunat(ValueBoolean $enviarSunat): void
    {
        $this->enviarSunat = $enviarSunat;
    }

    /**
     * @return ValueBoolean
     */
    public function getEnviarCliente(): ValueBoolean
    {
        return $this->enviarCliente;
    }

    /**
     * @param ValueBoolean $enviarCliente
     */
    public function setEnviarCliente(ValueBoolean $enviarCliente): void
    {
        $this->enviarCliente = $enviarCliente;
    }

    /**
     * @return Text
     */
    public function getCondicionesPago(): Text
    {
        return $this->condicionesPago;
    }

    /**
     * @param Text $condicionesPago
     */
    public function setCondicionesPago(Text $condicionesPago): void
    {
        $this->condicionesPago = $condicionesPago;
    }

    /**
     * @return Text
     */
    public function getMedioPago(): Text
    {
        return $this->medioPago;
    }

    /**
     * @param Text $medioPago
     */
    public function setMedioPago(Text $medioPago): void
    {
        $this->medioPago = $medioPago;
    }

    /**
     * @return Text
     */
    public function getPlacaVehiculo(): Text
    {
        return $this->placaVehiculo;
    }

    /**
     * @param Text $placaVehiculo
     */
    public function setPlacaVehiculo(Text $placaVehiculo): void
    {
        $this->placaVehiculo = $placaVehiculo;
    }

    /**
     * @return Text
     */
    public function getOrdenComproServicio(): Text
    {
        return $this->ordenComproServicio;
    }

    /**
     * @param Text $ordenComproServicio
     */
    public function setOrdenComproServicio(Text $ordenComproServicio): void
    {
        $this->ordenComproServicio = $ordenComproServicio;
    }

    /**
     * @return ValueBoolean
     */
    public function getDetraccion(): ValueBoolean
    {
        return $this->detraccion;
    }

    /**
     * @param ValueBoolean $detraccion
     */
    public function setDetraccion(ValueBoolean $detraccion): void
    {
        $this->detraccion = $detraccion;
    }

    /**
     * @return Id
     */
    public function getIdDetraccion(): Id
    {
        return $this->idDetraccion;
    }

    /**
     * @param Id $idDetraccion
     */
    public function setIdDetraccion(Id $idDetraccion): void
    {
        $this->idDetraccion = $idDetraccion;
    }

    /**
     * @return Text
     */
    public function getFormatoPdf(): Text
    {
        return $this->formatoPdf;
    }

    /**
     * @param Text $formatoPdf
     */
    public function setFormatoPdf(Text $formatoPdf): void
    {
        $this->formatoPdf = $formatoPdf;
    }

    /**
     * @return ValueBoolean
     */
    public function getContingencia(): ValueBoolean
    {
        return $this->contingencia;
    }

    /**
     * @param ValueBoolean $contingencia
     */
    public function setContingencia(ValueBoolean $contingencia): void
    {
        $this->contingencia = $contingencia;
    }

    /**
     * @return ValueBoolean
     */
    public function getBienesRegionSelva(): ValueBoolean
    {
        return $this->bienesRegionSelva;
    }

    /**
     * @param ValueBoolean $bienesRegionSelva
     */
    public function setBienesRegionSelva(ValueBoolean $bienesRegionSelva): void
    {
        $this->bienesRegionSelva = $bienesRegionSelva;
    }

    /**
     * @return ValueBoolean
     */
    public function getServicioRegionSelva(): ValueBoolean
    {
        return $this->servicioRegionSelva;
    }

    /**
     * @param ValueBoolean $servicioRegionSelva
     */
    public function setServicioRegionSelva(ValueBoolean $servicioRegionSelva): void
    {
        $this->servicioRegionSelva = $servicioRegionSelva;
    }

    /**
     * @return NumericInteger
     */
    public function getIdRazon(): NumericInteger
    {
        return $this->idRazon;
    }

    /**
     * @param NumericInteger $idRazon
     */
    public function setIdRazon(NumericInteger $idRazon): void
    {
        $this->idRazon = $idRazon;
    }

    /**
     * @return Id
     */
    public function getIdProducto(): Id
    {
        return $this->idProducto;
    }

    /**
     * @param Id $idProducto
     */
    public function setIdProducto(Id $idProducto): void
    {
        $this->idProducto = $idProducto;
    }

    /**
     * @return NumericInteger
     */
    public function getIdEstado(): NumericInteger
    {
        return $this->idEstado;
    }

    /**
     * @param NumericInteger $idEstado
     */
    public function setIdEstado(NumericInteger $idEstado): void
    {
        $this->idEstado = $idEstado;
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

    /**
     * @return ComprobanteElectronicoItemList
     */
    public function getItems(): ComprobanteElectronicoItemList
    {
        return $this->items;
    }

    /**
     * @param ComprobanteElectronicoItemList $items
     */
    public function setItems(ComprobanteElectronicoItemList $items): void
    {
        $this->items = $items;
    }




}
