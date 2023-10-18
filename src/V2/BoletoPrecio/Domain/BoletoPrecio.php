<?php
declare(strict_types=1);

namespace Src\V2\BoletoPrecio\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class BoletoPrecio
{
    private Id $id;
    private Id $idCliente;
    private NumericInteger $idTipoRuta;
    private Id $idRuta;
    private Id $idParaderoOrigen;
    private Id $idParaderoDestino;
    private NumericFloat $precioBase;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    private Text $tipoRuta;
    private Text $ruta;
    private Text $paraderoOrigen;
    private Text $paraderoDestino;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;


    /**
     * @param Id $id
     * @param Id $idCliente
     * @param NumericInteger $idTipoRuta
     * @param Id $idRuta
     * @param Id $idParaderoOrigen
     * @param Id $idParaderoDestino
     * @param NumericFloat $precioBase
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        NumericInteger $idTipoRuta,
        Id $idRuta,

        Id $idParaderoOrigen,
        Id $idParaderoDestino,
        NumericFloat $precioBase,

        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idTipoRuta = $idTipoRuta;
        $this->idRuta = $idRuta;
        $this->idParaderoOrigen = $idParaderoOrigen;
        $this->idParaderoDestino = $idParaderoDestino;
        $this->precioBase = $precioBase;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
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
     * @return NumericInteger
     */
    public function getIdTipoRuta(): NumericInteger
    {
        return $this->idTipoRuta;
    }

    /**
     * @param NumericInteger $idTipoRuta
     */
    public function setIdTipoRuta(NumericInteger $idTipoRuta): void
    {
        $this->idTipoRuta = $idTipoRuta;
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
    public function getPrecioBase(): NumericFloat
    {
        return $this->precioBase;
    }

    /**
     * @param NumericFloat $precioBase
     */
    public function setPrecioBase(NumericFloat $precioBase): void
    {
        $this->precioBase = $precioBase;
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
    public function getTipoRuta(): Text
    {
        return $this->tipoRuta;
    }

    /**
     * @param Text $tipoRuta
     */
    public function setTipoRuta(Text $tipoRuta): void
    {
        $this->tipoRuta = $tipoRuta;
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
