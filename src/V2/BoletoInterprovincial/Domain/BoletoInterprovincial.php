<?php
declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class BoletoInterprovincial
{
    private Id $id;
    private Id $idCliente;
    private Id $idVehiculo;
    private Id $idRuta;
    private Id $idParadero;
    private Id $idCaja;
    private Id $idPos;
    private NumericInteger $idTipoDocumento;
    private Text $numeroDocumento;
    private Text $codigoBoleto;
    private NumericFloat $latitud;
    private NumericFloat $longitud;
    private NumericFloat $precio;
    private DateTimeFormat $fecha;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    private Text $vehiculo;
    private Text $ruta;
    private Text $paradero;
    private Text $caja;
    private Text $pos;
    private Text $tipoDocumento;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $nombre;
    private Text $serie;
    private Text $numeroBoleto;
    private NumericInteger $enBlanco;
    private Text $direccion;

    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idVehiculo
     * @param Id $idRuta
     * @param Id $idParadero
     * @param Id $idCaja
     * @param Id $idPos
     * @param NumericInteger $idTipoDocumento
     * @param Text $numeroDocumento
     * @param Text $nombre
     * @param Text $direccion
     * @param Text $serie
     * @param Text $numeroBoleto
     * @param Text $codigoBoleto
     * @param NumericFloat $latitud
     * @param NumericFloat $longitud
     * @param NumericFloat $precio
     * @param DateTimeFormat $fecha
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param NumericInteger $enBlanco
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        Id $idVehiculo,
        Id $idRuta,
        Id $idParadero,
        Id $idCaja,
        Id $idPos,
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Text $serie,
        Text $numeroBoleto,
        Text $codigoBoleto,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericFloat $precio,
        DateTimeFormat $fecha,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        NumericInteger $enBlanco,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idVehiculo = $idVehiculo;
        $this->idRuta = $idRuta;
        $this->idParadero = $idParadero;
        $this->idCaja = $idCaja;
        $this->idPos = $idPos;
        $this->numeroDocumento = $numeroDocumento;
        $this->codigoBoleto = $codigoBoleto;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->precio = $precio;
        $this->fecha = $fecha;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->nombre = $nombre;
        $this->serie = $serie;
        $this->numeroBoleto = $numeroBoleto;
        $this->enBlanco = $enBlanco;
        $this->direccion = $direccion;
        $this->idTipoDocumento = $idTipoDocumento;
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
    public function getCodigoBoleto(): Text
    {
        return $this->codigoBoleto;
    }

    /**
     * @param Text $codigoBoleto
     */
    public function setCodigoBoleto(Text $codigoBoleto): void
    {
        $this->codigoBoleto = $codigoBoleto;
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
     * @return DateTimeFormat
     */
    public function getFecha(): DateTimeFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateTimeFormat $fecha
     */
    public function setFecha(DateTimeFormat $fecha): void
    {
        $this->fecha = $fecha;
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
     * @return NumericInteger
     */
    public function getIdEliminado(): NumericInteger
    {
        return $this->idEliminado;
    }

    /**
     * @param NumericInteger $idEliminado
     */
    public function setIdEliminado(NumericInteger $idEliminado): void
    {
        $this->idEliminado = $idEliminado;
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
     * @return Text
     */
    public function getVehiculo(): Text
    {
        return $this->vehiculo;
    }

    /**
     * @param Text $vehiculo
     */
    public function setVehiculo(Text $vehiculo): void
    {
        $this->vehiculo = $vehiculo;
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
     * @return Text
     */
    public function getNumeroBoleto(): Text
    {
        return $this->numeroBoleto;
    }

    /**
     * @param Text $numeroBoleto
     */
    public function setNumeroBoleto(Text $numeroBoleto): void
    {
        $this->numeroBoleto = $numeroBoleto;
    }

    /**
     * @return NumericInteger
     */
    public function getEnBlanco(): NumericInteger
    {
        return $this->enBlanco;
    }

    /**
     * @param NumericInteger $enBlanco
     */
    public function setEnBlanco(NumericInteger $enBlanco): void
    {
        $this->enBlanco = $enBlanco;
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


}
