<?php

namespace Src\V2\BoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

class BoletoInterprovincialOficial
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
    private DateFormat $horaPartida;
    private Id $idRuta;
    private Id $idParadero;
    private NumericFloat $precio;
    private NumericInteger $idTipoMoneda;
    private NumericInteger $idFormaPago;
    private NumericInteger $obsequio;
    private NumericInteger $idTipoComprobante;
    private NumericInteger $idTipoDocumentoEntidad;
    private Text $numeroDocumentoEntidad;
    private Text $nombreEntidad;
    private Text $direccionEntidad;
    private Id $idUsuarioRegistro;


    private Text $sede;
    private Text $caja;
    private Text $tipoDocumento;
    private Text $vehiculoPlaca;
    private Text $ruta;
    private Text $paradero;
    private Text $tipoMoneda;
    private Text $formaPago;
    private Text $tipoComprobante;
    private Text $tipoDocumentoEntidad;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;

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
     * @param DateFormat $horaPartida
     * @param Id $idRuta
     * @param Id $idParadero
     * @param NumericFloat $precio
     * @param NumericInteger $idTipoMoneda
     * @param NumericInteger $idFormaPago
     * @param NumericInteger $obsequio
     * @param NumericInteger $idTipoComprobante
     * @param NumericInteger $idTipoDocumentoEntidad
     * @param Text $numeroDocumentoEntidad
     * @param Text $nombreEntidad
     * @param Text $direccionEntidad
     * @param Id $idUsuarioRegistro
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
        DateFormat $horaPartida,
        Id $idRuta,
        Id $idParadero,
        NumericFloat $precio,
        NumericInteger $idTipoMoneda,
        NumericInteger $idFormaPago,
        NumericInteger $obsequio,

        NumericInteger $idTipoComprobante,
        NumericInteger $idTipoDocumentoEntidad,
        Text $numeroDocumentoEntidad,
        Text $nombreEntidad,
        Text $direccionEntidad,

        Id $idUsuarioRegistro
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
        $this->idParadero = $idParadero;
        $this->precio = $precio;
        $this->idTipoMoneda = $idTipoMoneda;
        $this->idFormaPago = $idFormaPago;
        $this->obsequio = $obsequio;
        $this->idTipoComprobante = $idTipoComprobante;
        $this->idTipoDocumentoEntidad = $idTipoDocumentoEntidad;
        $this->numeroDocumentoEntidad = $numeroDocumentoEntidad;
        $this->nombreEntidad = $nombreEntidad;
        $this->direccionEntidad = $direccionEntidad;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
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
     * @return DateFormat
     */
    public function getHoraPartida(): DateFormat
    {
        return $this->horaPartida;
    }

    /**
     * @param DateFormat $horaPartida
     */
    public function setHoraPartida(DateFormat $horaPartida): void
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
    public function getIdParadero(): Id
    {
        return $this->idParadero;
    }

    /**
     * @param Id $idParadero
     */
    public function setIdParadero(Id $idParadero): void
    {
        $this->idParadero = $idParadero;
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
    public function getIdTipoDocumentoEntidad(): NumericInteger
    {
        return $this->idTipoDocumentoEntidad;
    }

    /**
     * @param NumericInteger $idTipoDocumentoEntidad
     */
    public function setIdTipoDocumentoEntidad(NumericInteger $idTipoDocumentoEntidad): void
    {
        $this->idTipoDocumentoEntidad = $idTipoDocumentoEntidad;
    }

    /**
     * @return Text
     */
    public function getNumeroDocumentoEntidad(): Text
    {
        return $this->numeroDocumentoEntidad;
    }

    /**
     * @param Text $numeroDocumentoEntidad
     */
    public function setNumeroDocumentoEntidad(Text $numeroDocumentoEntidad): void
    {
        $this->numeroDocumentoEntidad = $numeroDocumentoEntidad;
    }

    /**
     * @return Text
     */
    public function getNombreEntidad(): Text
    {
        return $this->nombreEntidad;
    }

    /**
     * @param Text $nombreEntidad
     */
    public function setNombreEntidad(Text $nombreEntidad): void
    {
        $this->nombreEntidad = $nombreEntidad;
    }

    /**
     * @return Text
     */
    public function getDireccionEntidad(): Text
    {
        return $this->direccionEntidad;
    }

    /**
     * @param Text $direccionEntidad
     */
    public function setDireccionEntidad(Text $direccionEntidad): void
    {
        $this->direccionEntidad = $direccionEntidad;
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
    public function getParadero(): Text
    {
        return $this->paradero;
    }

    /**
     * @param Text $paradero
     */
    public function setParadero(Text $paradero): void
    {
        $this->paradero = $paradero;
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
    public function getTipoDocumentoEntidad(): Text
    {
        return $this->tipoDocumentoEntidad;
    }

    /**
     * @param Text $tipoDocumentoEntidad
     */
    public function setTipoDocumentoEntidad(Text $tipoDocumentoEntidad): void
    {
        $this->tipoDocumentoEntidad = $tipoDocumentoEntidad;
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


}
