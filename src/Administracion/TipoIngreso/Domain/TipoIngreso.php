<?php

declare(strict_types=1);

namespace Src\Administracion\TipoIngreso\Domain;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;

final class TipoIngreso
{
    /**
     * @var Text
     */
    private $usuarioRegistro;
    /**
     * @var Text
     */
    private $usuarioModifico;
    /**
     * @var Id
     */
    private  $id;
    /**
     * @var Text
     */
    private  $nombre;
    /**
     * @var Text
     */
    private  $descripcion;
    /**
     * @var float|int|Numeric|string
     */
    private $registraPersonal;
    /**
     * @var float|int|Numeric|string
     */
    private  $registraRuta;
    /**
     * @var Id
     */
    private  $idCliente;
    /**
     * @var float|int|Numeric|string
     */
    private  $idEstado;
    /**
     * @var Id
     */
    private  $idUsuarioRegistro;
    /**
     * @var DateTimeFormat
     */
    private  $fechaRegistro;
    /**
     * @var Id
     */
    private  $idUsuarioModifico;
    /**
     * @var DateTimeFormat
     */
    private  $fechaModifico;
    /**
     * @var float|int|Numeric|string
     */
    private $registraVehiculo;

    /**
     * TipoIngreso constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Text $descripcion
     * @param Numeric $registraVehiculo
     * @param Numeric $registraPersonal
     * @param Numeric $registraRuta
     * @param Id $idCliente
     * @param Numeric $idEstado
     * @param Id $idUsuarioRegistro
     * @param DateTimeFormat $fechaRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $descripcion,
        Numeric $registraVehiculo,
        Numeric $registraPersonal,
        Numeric $registraRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        DateTimeFormat $fechaRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->registraPersonal = $registraPersonal;
        $this->registraRuta = $registraRuta;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->fechaRegistro = $fechaRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaModifico = $fechaModifico;
        $this->registraVehiculo = $registraVehiculo;
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
     * @return float|int|string
     */
    public function getRegistraPersonal()
    {
        return $this->registraPersonal;
    }

    /**
     * @param float|int|string $registraPersonal
     */
    public function setRegistraPersonal($registraPersonal): void
    {
        $this->registraPersonal = $registraPersonal;
    }

    /**
     * @return float|int|string
     */
    public function getRegistraRuta()
    {
        return $this->registraRuta;
    }

    /**
     * @param float|int|string $registraRuta
     */
    public function setRegistraRuta($registraRuta): void
    {
        $this->registraRuta = $registraRuta;
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
     * @return float|int|string
     */
    public function getRegistraVehiculo()
    {
        return $this->registraVehiculo;
    }

    /**
     * @param float|int|string $registraVehiculo
     */
    public function setRegistraVehiculo($registraVehiculo): void
    {
        $this->registraVehiculo = $registraVehiculo;
    }


}
