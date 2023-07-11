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
    private Id $idDestino;
    private Text $numeroDocumento;
    private Text $codigoBoleto;
    private NumericFloat $latitud;
    private NumericFloat $longitud;
    private NumericFloat $precio;
    private DateTimeFormat $fecha;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsurioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $vehiculo;
    private Text $destino;


    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idVehiculo
     * @param Id $idDestino
     * @param Text $numeroDocumento
     * @param Text $codigoBoleto
     * @param NumericFloat $latitud
     * @param NumericFloat $longitud
     * @param NumericFloat $precio
     * @param DateTimeFormat $fecha
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idUsurioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        Id $idVehiculo,
        Id $idDestino,
        Text $numeroDocumento,
        Text $codigoBoleto,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericFloat $precio,
        DateTimeFormat $fecha,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idUsurioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idVehiculo = $idVehiculo;
        $this->idDestino = $idDestino;
        $this->numeroDocumento = $numeroDocumento;
        $this->codigoBoleto = $codigoBoleto;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->precio = $precio;
        $this->fecha = $fecha;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsurioRegistro = $idUsurioRegistro;
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
    public function getIdDestino(): Id
    {
        return $this->idDestino;
    }

    /**
     * @param Id $idDestino
     */
    public function setIdDestino(Id $idDestino): void
    {
        $this->idDestino = $idDestino;
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
    public function getIdUsurioRegistro(): Id
    {
        return $this->idUsurioRegistro;
    }

    /**
     * @param Id $idUsurioRegistro
     */
    public function setIdUsurioRegistro(Id $idUsurioRegistro): void
    {
        $this->idUsurioRegistro = $idUsurioRegistro;
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
    public function getDestino(): Text
    {
        return $this->destino;
    }

    /**
     * @param Text $destino
     */
    public function setDestino(Text $destino): void
    {
        $this->destino = $destino;
    }

}
