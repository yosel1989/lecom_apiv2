<?php

declare(strict_types=1);

namespace Src\Administracion\HojaRuta\Domain;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;

final class HojaRuta
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var Id
     */
    private $idVehiculo;
    /**
     * @var Id
     */
    private $idPersonal;
    /**
     * @var DateOnlyFormat
     */
    private $fechaAsignada;
    /**
     * @var TimeFormat
     */
    private $horaAsignada;
    /**
     * @var Text
     */
    private $urlHojaRuta;
    /**
     * @var Id
     */
    private $idCliente;
    /**
     * @var float|int|Numeric|string
     */
    private $idEstado;
    /**
     * @var Id
     */
    private $idUsuarioRegistro;
    /**
     * @var DateTimeFormat
     */
    private $fechaRegistro;
    /**
     * @var Id
     */
    private $idUsuarioModifico;
    /**
     * @var DateTimeFormat
     */
    private $fechaModifico;
    /**
     * @var Text
     */
    private $usuarioRegistro;
    /**
     * @var Text
     */
    private $usuarioModifico;
    /**
     * @var Text
     */
    private $personal;
    /**
     * @var Text
     */
    private $placa;
    /**
     * @var Id
     */
    private $idRuta;
    /**
     * @var Text
     */
    private $ruta;

    /**
     * HojaRuta constructor.
     * @param Id $id
     * @param Id $idVehiculo
     * @param Id $idPersonal
     * @param Id $idRuta
     * @param DateOnlyFormat $fechaAsignada
     * @param TimeFormat $horaAsignada
     * @param Text $urlHojaRuta
     * @param Id $idCliente
     * @param Numeric $idEstado
     * @param Id $idUsuarioRegistro
     * @param DateTimeFormat $fechaRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        DateOnlyFormat $fechaAsignada,
        TimeFormat $horaAsignada,
        Text $urlHojaRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        DateTimeFormat $fechaRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idVehiculo = $idVehiculo;
        $this->idPersonal = $idPersonal;
        $this->fechaAsignada = $fechaAsignada;
        $this->horaAsignada = $horaAsignada;
        $this->urlHojaRuta = $urlHojaRuta;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->fechaRegistro = $fechaRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaModifico = $fechaModifico;
        $this->idRuta = $idRuta;
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
    public function getIdPersonal(): Id
    {
        return $this->idPersonal;
    }

    /**
     * @param Id $idPersonal
     */
    public function setIdPersonal(Id $idPersonal): void
    {
        $this->idPersonal = $idPersonal;
    }

    /**
     * @return DateOnlyFormat
     */
    public function getFechaAsignada(): DateOnlyFormat
    {
        return $this->fechaAsignada;
    }

    /**
     * @param DateOnlyFormat $fechaAsignada
     */
    public function setFechaAsignada(DateOnlyFormat $fechaAsignada): void
    {
        $this->fechaAsignada = $fechaAsignada;
    }

    /**
     * @return TimeFormat
     */
    public function getHoraAsignada(): TimeFormat
    {
        return $this->horaAsignada;
    }

    /**
     * @param TimeFormat $horaAsignada
     */
    public function setHoraAsignada(TimeFormat $horaAsignada): void
    {
        $this->horaAsignada = $horaAsignada;
    }

    /**
     * @return Text
     */
    public function getUrlHojaRuta(): Text
    {
        return $this->urlHojaRuta;
    }

    /**
     * @param Text $urlHojaRuta
     */
    public function setUrlHojaRuta(Text $urlHojaRuta): void
    {
        $this->urlHojaRuta = $urlHojaRuta;
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
     * @return float|int|string
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param float|int|string $idEstado
     */
    public function setIdEstado($idEstado): void
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
    public function getPersonal(): Text
    {
        return $this->personal;
    }

    /**
     * @param Text $personal
     */
    public function setPersonal(Text $personal): void
    {
        $this->personal = $personal;
    }

    /**
     * @return Text
     */
    public function getPlaca(): Text
    {
        return $this->placa;
    }

    /**
     * @param Text $placa
     */
    public function setPlaca(Text $placa): void
    {
        $this->placa = $placa;
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



}
