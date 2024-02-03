<?php

namespace Src\V2\BoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\TimeFormat;

final class BoletoInterprovincialOficial
{
    private Id $id;
    private Id $idCliente;
    private Id $idSede;
    private Id $idCaja;
    private NumericInteger $idTipoDocumento;
    private Text $numeroDocumento;
    private Text $nombres;
    private Text $apellidos;
    private NumericInteger $menorEdad;
    private Id $idVehiculo;
    private Id $idAsiento;
    private DateFormat $fechaPartida;
    private TimeFormat $horaPartida;
    private Id $idRuta;
    private Id $idParaderoOrigen;
    private Id $idParaderoDestino;
    private NumericFloat $precio;
    private NumericInteger $idTipoMoneda;
    private NumericInteger $idFormaPago;
    private NumericInteger $obsequio;
    private Id $idPos;
    private Text $codigo;
    private NumericFloat $latitud;
    private NumericFloat $longitud;
    private DateTimeFormat $fechaEmision;
    private NumericInteger $idEstado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;
    private NumericInteger $idTipoComprobante;
    private NumericInteger $idTipoBoleto;
    private NumericInteger $porPagar;
    private NumericInteger $idOrigen;
    private Id $idCajaDiario;
    private Id $idLiquidacion;


    // optional
    private Text $estado;
    private Text $tipoDocumento;
    private Text $sede;
    private Text $caja;
    private Text $vehiculoPlaca;
    private Text $ruta;
    private Text $paraderoOrigen;
    private Text $paraderoDestino;
    private Text $tipoMoneda;
    private Text $formaPago;
    private Text $pos;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $tipoComprobante;
    private Text $comprobanteSerie;
    private NumericInteger $comprobanteNumero;
    private Text $tipoBoleto;
    private Text $cliente;
    private Text $origen;

    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idSede
     * @param Id $idCaja
     * @param NumericInteger $idTipoDocumento
     * @param Text $numeroDocumento
     * @param Text $nombres
     * @param Text $apellidos
     * @param NumericInteger $menorEdad
     * @param Id $idVehiculo
     * @param Id $idAsiento
     * @param DateFormat $fechaPartida
     * @param TimeFormat $horaPartida
     * @param Id $idRuta
     * @param Id $idParaderoOrigen
     * @param Id $idParaderoDestino
     * @param NumericFloat $precio
     * @param NumericInteger $idTipoMoneda
     * @param NumericInteger $idFormaPago
     * @param NumericInteger $obsequio
     * @param Id $idPos
     * @param Text $codigo
     * @param NumericFloat $latitud
     * @param NumericFloat $longitud
     * @param DateTimeFormat $fechaEmision
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     * @param NumericInteger $idTipoComprobante
     * @param NumericInteger $idTipoBoleto
     * @param NumericInteger $porPagar
     */
    public function __construct(
        Id $id,

        Id $idCliente,
        Id $idSede,
        Id $idCaja,
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombres,
        Text $apellidos,
        NumericInteger $menorEdad,

        Id $idVehiculo,
        Id $idAsiento,
        DateFormat $fechaPartida,
        TimeFormat $horaPartida,
        Id $idRuta,
        Id $idParaderoOrigen,
        Id $idParaderoDestino,

        NumericFloat $precio,
        NumericInteger $idTipoMoneda,
        NumericInteger $idFormaPago,
        NumericInteger $obsequio,

        Id $idPos,
        Text $codigo,
        NumericFloat $latitud,
        NumericFloat $longitud,
        DateTimeFormat $fechaEmision,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico,
        NumericInteger $idTipoComprobante,
        NumericInteger $idTipoBoleto,
        NumericInteger $porPagar
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idSede = $idSede;
        $this->idCaja = $idCaja;
        $this->idTipoDocumento = $idTipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->menorEdad = $menorEdad;
        $this->idVehiculo = $idVehiculo;
        $this->idAsiento = $idAsiento;
        $this->fechaPartida = $fechaPartida;
        $this->horaPartida = $horaPartida;
        $this->idRuta = $idRuta;
        $this->idParaderoOrigen = $idParaderoOrigen;
        $this->idParaderoDestino = $idParaderoDestino;
        $this->precio = $precio;
        $this->idTipoMoneda = $idTipoMoneda;
        $this->idFormaPago = $idFormaPago;
        $this->obsequio = $obsequio;
        $this->idPos = $idPos;
        $this->codigo = $codigo;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->fechaEmision = $fechaEmision;
        $this->idEstado = $idEstado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->idTipoComprobante = $idTipoComprobante;
        $this->idTipoBoleto = $idTipoBoleto;
        $this->porPagar = $porPagar;
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
     * @return Id
     */
    public function getIdCaja(): Id
    {
        return $this->idCaja;
    }

    /**
     * @param Id $idCaja
     */
    public function setIdCaja(Id $idCaja): void
    {
        $this->idCaja = $idCaja;
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
    public function getNombres(): Text
    {
        return $this->nombres;
    }

    /**
     * @param Text $nombres
     */
    public function setNombres(Text $nombres): void
    {
        $this->nombres = $nombres;
    }

    /**
     * @return Text
     */
    public function getApellidos(): Text
    {
        return $this->apellidos;
    }

    /**
     * @param Text $apellidos
     */
    public function setApellidos(Text $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return NumericInteger
     */
    public function getMenorEdad(): NumericInteger
    {
        return $this->menorEdad;
    }

    /**
     * @param NumericInteger $menorEdad
     */
    public function setMenorEdad(NumericInteger $menorEdad): void
    {
        $this->menorEdad = $menorEdad;
    }

    /**
     * @return Id
     */
    public function getIdVehiculo(): Id
    {
        return $this->idVehiculo;
    }

    /**
     * @param Id $idVehiculo
     */
    public function setIdVehiculo(Id $idVehiculo): void
    {
        $this->idVehiculo = $idVehiculo;
    }

    /**
     * @return Id
     */
    public function getIdAsiento(): Id
    {
        return $this->idAsiento;
    }

    /**
     * @param Id $idAsiento
     */
    public function setIdAsiento(Id $idAsiento): void
    {
        $this->idAsiento = $idAsiento;
    }

    /**
     * @return DateFormat
     */
    public function getFechaPartida(): DateFormat
    {
        return $this->fechaPartida;
    }

    /**
     * @param DateFormat $fechaPartida
     */
    public function setFechaPartida(DateFormat $fechaPartida): void
    {
        $this->fechaPartida = $fechaPartida;
    }

    /**
     * @return TimeFormat
     */
    public function getHoraPartida(): TimeFormat
    {
        return $this->horaPartida;
    }

    /**
     * @param TimeFormat $horaPartida
     */
    public function setHoraPartida(TimeFormat $horaPartida): void
    {
        $this->horaPartida = $horaPartida;
    }

    /**
     * @return Id
     */
    public function getIdRuta(): Id
    {
        return $this->idRuta;
    }

    /**
     * @param Id $idRuta
     */
    public function setIdRuta(Id $idRuta): void
    {
        $this->idRuta = $idRuta;
    }

    /**
     * @return Id
     */
    public function getIdParaderoOrigen(): Id
    {
        return $this->idParaderoOrigen;
    }

    /**
     * @param Id $idParaderoOrigen
     */
    public function setIdParaderoOrigen(Id $idParaderoOrigen): void
    {
        $this->idParaderoOrigen = $idParaderoOrigen;
    }

    /**
     * @return Id
     */
    public function getIdParaderoDestino(): Id
    {
        return $this->idParaderoDestino;
    }

    /**
     * @param Id $idParaderoDestino
     */
    public function setIdParaderoDestino(Id $idParaderoDestino): void
    {
        $this->idParaderoDestino = $idParaderoDestino;
    }

    /**
     * @return NumericFloat
     */
    public function getPrecio(): NumericFloat
    {
        return $this->precio;
    }

    /**
     * @param NumericFloat $precio
     */
    public function setPrecio(NumericFloat $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoMoneda(): NumericInteger
    {
        return $this->idTipoMoneda;
    }

    /**
     * @param NumericInteger $idTipoMoneda
     */
    public function setIdTipoMoneda(NumericInteger $idTipoMoneda): void
    {
        $this->idTipoMoneda = $idTipoMoneda;
    }

    /**
     * @return NumericInteger
     */
    public function getIdFormaPago(): NumericInteger
    {
        return $this->idFormaPago;
    }

    /**
     * @param NumericInteger $idFormaPago
     */
    public function setIdFormaPago(NumericInteger $idFormaPago): void
    {
        $this->idFormaPago = $idFormaPago;
    }

    /**
     * @return NumericInteger
     */
    public function getObsequio(): NumericInteger
    {
        return $this->obsequio;
    }

    /**
     * @param NumericInteger $obsequio
     */
    public function setObsequio(NumericInteger $obsequio): void
    {
        $this->obsequio = $obsequio;
    }

    /**
     * @return Id
     */
    public function getIdPos(): Id
    {
        return $this->idPos;
    }

    /**
     * @param Id $idPos
     */
    public function setIdPos(Id $idPos): void
    {
        $this->idPos = $idPos;
    }

    /**
     * @return Text
     */
    public function getCodigo(): Text
    {
        return $this->codigo;
    }

    /**
     * @param Text $codigo
     */
    public function setCodigo(Text $codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return NumericFloat
     */
    public function getLatitud(): NumericFloat
    {
        return $this->latitud;
    }

    /**
     * @param NumericFloat $latitud
     */
    public function setLatitud(NumericFloat $latitud): void
    {
        $this->latitud = $latitud;
    }

    /**
     * @return NumericFloat
     */
    public function getLongitud(): NumericFloat
    {
        return $this->longitud;
    }

    /**
     * @param NumericFloat $longitud
     */
    public function setLongitud(NumericFloat $longitud): void
    {
        $this->longitud = $longitud;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaEmision(): DateTimeFormat
    {
        return $this->fechaEmision;
    }

    /**
     * @param DateTimeFormat $fechaEmision
     */
    public function setFechaEmision(DateTimeFormat $fechaEmision): void
    {
        $this->fechaEmision = $fechaEmision;
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
     * @return NumericInteger
     */
    public function getIdTipoBoleto(): NumericInteger
    {
        return $this->idTipoBoleto;
    }

    /**
     * @param NumericInteger $idTipoBoleto
     */
    public function setIdTipoBoleto(NumericInteger $idTipoBoleto): void
    {
        $this->idTipoBoleto = $idTipoBoleto;
    }

    /**
     * @return NumericInteger
     */
    public function getPorPagar(): NumericInteger
    {
        return $this->porPagar;
    }

    /**
     * @param NumericInteger $porPagar
     */
    public function setPorPagar(NumericInteger $porPagar): void
    {
        $this->porPagar = $porPagar;
    }

    /**
     * @return Text
     */
    public function getTipoDocumento(): Text
    {
        return $this->tipoDocumento;
    }

    /**
     * @param Text $tipoDocumento
     */
    public function setTipoDocumento(Text $tipoDocumento): void
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    /**
     * @return Text
     */
    public function getSede(): Text
    {
        return $this->sede;
    }

    /**
     * @param Text $sede
     */
    public function setSede(Text $sede): void
    {
        $this->sede = $sede;
    }

    /**
     * @return Text
     */
    public function getCaja(): Text
    {
        return $this->caja;
    }

    /**
     * @param Text $caja
     */
    public function setCaja(Text $caja): void
    {
        $this->caja = $caja;
    }

    /**
     * @return Text
     */
    public function getVehiculoPlaca(): Text
    {
        return $this->vehiculoPlaca;
    }

    /**
     * @param Text $vehiculoPlaca
     */
    public function setVehiculoPlaca(Text $vehiculoPlaca): void
    {
        $this->vehiculoPlaca = $vehiculoPlaca;
    }

    /**
     * @return Text
     */
    public function getRuta(): Text
    {
        return $this->ruta;
    }

    /**
     * @param Text $ruta
     */
    public function setRuta(Text $ruta): void
    {
        $this->ruta = $ruta;
    }

    /**
     * @return Text
     */
    public function getParaderoOrigen(): Text
    {
        return $this->paraderoOrigen;
    }

    /**
     * @param Text $paraderoOrigen
     */
    public function setParaderoOrigen(Text $paraderoOrigen): void
    {
        $this->paraderoOrigen = $paraderoOrigen;
    }

    /**
     * @return Text
     */
    public function getParaderoDestino(): Text
    {
        return $this->paraderoDestino;
    }

    /**
     * @param Text $paraderoDestino
     */
    public function setParaderoDestino(Text $paraderoDestino): void
    {
        $this->paraderoDestino = $paraderoDestino;
    }

    /**
     * @return Text
     */
    public function getTipoMoneda(): Text
    {
        return $this->tipoMoneda;
    }

    /**
     * @param Text $tipoMoneda
     */
    public function setTipoMoneda(Text $tipoMoneda): void
    {
        $this->tipoMoneda = $tipoMoneda;
    }

    /**
     * @return Text
     */
    public function getFormaPago(): Text
    {
        return $this->formaPago;
    }

    /**
     * @param Text $formaPago
     */
    public function setFormaPago(Text $formaPago): void
    {
        $this->formaPago = $formaPago;
    }

    /**
     * @return Text
     */
    public function getPos(): Text
    {
        return $this->pos;
    }

    /**
     * @param Text $pos
     */
    public function setPos(Text $pos): void
    {
        $this->pos = $pos;
    }

    /**
     * @return Text
     */
    public function getUsuarioRegistro(): Text
    {
        return $this->usuarioRegistro;
    }

    /**
     * @param Text $usuarioRegistro
     */
    public function setUsuarioRegistro(Text $usuarioRegistro): void
    {
        $this->usuarioRegistro = $usuarioRegistro;
    }

    /**
     * @return Text
     */
    public function getUsuarioModifico(): Text
    {
        return $this->usuarioModifico;
    }

    /**
     * @param Text $usuarioModifico
     */
    public function setUsuarioModifico(Text $usuarioModifico): void
    {
        $this->usuarioModifico = $usuarioModifico;
    }

    /**
     * @return Text
     */
    public function getTipoComprobante(): Text
    {
        return $this->tipoComprobante;
    }

    /**
     * @param Text $tipoComprobante
     */
    public function setTipoComprobante(Text $tipoComprobante): void
    {
        $this->tipoComprobante = $tipoComprobante;
    }

    /**
     * @return Text
     */
    public function getTipoBoleto(): Text
    {
        return $this->tipoBoleto;
    }

    /**
     * @param Text $tipoBoleto
     */
    public function setTipoBoleto(Text $tipoBoleto): void
    {
        $this->tipoBoleto = $tipoBoleto;
    }

    /**
     * @return Text
     */
    public function getCliente(): Text
    {
        return $this->cliente;
    }

    /**
     * @param Text $cliente
     */
    public function setCliente(Text $cliente): void
    {
        $this->cliente = $cliente;
    }

    /**
     * @return Text
     */
    public function getComprobanteSerie(): Text
    {
        return $this->comprobanteSerie;
    }

    /**
     * @param Text $comprobanteSerie
     */
    public function setComprobanteSerie(Text $comprobanteSerie): void
    {
        $this->comprobanteSerie = $comprobanteSerie;
    }

    /**
     * @return NumericInteger
     */
    public function getComprobanteNumero(): NumericInteger
    {
        return $this->comprobanteNumero;
    }

    /**
     * @param NumericInteger $comprobanteNumero
     */
    public function setComprobanteNumero(NumericInteger $comprobanteNumero): void
    {
        $this->comprobanteNumero = $comprobanteNumero;
    }

    /**
     * @return Text
     */
    public function getOrigen(): Text
    {
        return $this->origen;
    }

    /**
     * @param Text $origen
     */
    public function setOrigen(Text $origen): void
    {
        $this->origen = $origen;
    }

    /**
     * @return NumericInteger
     */
    public function getIdOrigen(): NumericInteger
    {
        return $this->idOrigen;
    }

    /**
     * @param NumericInteger $idOrigen
     */
    public function setIdOrigen(NumericInteger $idOrigen): void
    {
        $this->idOrigen = $idOrigen;
    }

    /**
     * @return Id
     */
    public function getIdCajaDiario(): Id
    {
        return $this->idCajaDiario;
    }

    /**
     * @param Id $idCajaDiario
     */
    public function setIdCajaDiario(Id $idCajaDiario): void
    {
        $this->idCajaDiario = $idCajaDiario;
    }

    /**
     * @return Id
     */
    public function getIdLiquidacion(): Id
    {
        return $this->idLiquidacion;
    }

    /**
     * @param Id $idLiquidacion
     */
    public function setIdLiquidacion(Id $idLiquidacion): void
    {
        $this->idLiquidacion = $idLiquidacion;
    }

    /**
     * @return Text
     */
    public function getEstado(): Text
    {
        return $this->estado;
    }

    /**
     * @param Text $estado
     */
    public function setEstado(Text $estado): void
    {
        $this->estado = $estado;
    }


}
