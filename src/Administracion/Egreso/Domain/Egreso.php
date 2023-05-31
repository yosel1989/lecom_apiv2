<?php

declare(strict_types=1);

namespace Src\Administracion\Egreso\Domain;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class Egreso
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var DateOnlyFormat
     */
    private $fecha;
    /**
     * @var Id
     */
    private $idTipoEgreso;
    /**
     * @var Id
     */
    private $idVehiculo;
    /**
     * @var Id
     */
    private $idPersonal;
    /**
     * @var Id
     */
    private $idRuta;
    /**
     * @var float|int|Numeric|string
     */
    private $monto;
    /**
     * @var Text
     */
    private $observacion;
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
    private $vehiculo;

    /**
     * @var Text
     */
    private $personal;

    /**
     * @var Text
     */
    private $ruta;

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
    private $tipoEgreso;

    /**
     * Egreso constructor.
     * @param Id $id
     * @param DateOnlyFormat $fecha
     * @param Id $idTipoEgreso
     * @param Id $idVehiculo
     * @param Id $idPersonal
     * @param Id $idRuta
     * @param Numeric $monto
     * @param Text $observacion
     * @param Id $idCliente
     * @param Numeric $idEstado
     * @param Id $idUsuarioRegistro
     * @param DateTimeFormat $fechaRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        DateOnlyFormat $fecha,
        Id $idTipoEgreso,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        Numeric $monto,
        Text $observacion,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        DateTimeFormat $fechaRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaModifico
    )
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->idTipoEgreso = $idTipoEgreso;
        $this->idVehiculo = $idVehiculo;
        $this->idPersonal = $idPersonal;
        $this->idRuta = $idRuta;
        $this->monto = $monto;
        $this->observacion = $observacion;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->fechaRegistro = $fechaRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
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
     * @return DateOnlyFormat
     */
    public function getFecha(): DateOnlyFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateOnlyFormat $fecha
     */
    public function setFecha(DateOnlyFormat $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return Id
     */
    public function getIdTipoEgreso(): Id
    {
        return $this->idTipoEgreso;
    }

    /**
     * @param Id $idTipoEgreso
     */
    public function setIdTipoEgreso(Id $idTipoEgreso): void
    {
        $this->idTipoEgreso = $idTipoEgreso;
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
     * @return float|int|string
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * @param float|int|string $monto
     */
    public function setMonto($monto): void
    {
        $this->monto = $monto;
    }

    /**
     * @return Text
     */
    public function getObservacion(): Text
    {
        return $this->observacion;
    }

    /**
     * @param Text $observacion
     */
    public function setObservacion(Text $observacion): void
    {
        $this->observacion = $observacion;
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
    public function getTipoEgreso(): Text
    {
        return $this->tipoEgreso;
    }

    /**
     * @param Text $tipoEgreso
     */
    public function setTipoEgreso(Text $tipoEgreso): void
    {
        $this->tipoEgreso = $tipoEgreso;
    }


}
