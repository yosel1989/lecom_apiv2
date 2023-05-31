<?php

declare(strict_types=1);

namespace Src\Administracion\TipoEgreso\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class TipoEgreso_S
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var Text
     */
    private $nombre;
    /**
     * @var float|int|Numeric|string
     */
    private $registraPersonal;
    /**
     * @var float|int|Numeric|string
     */
    private $registraRuta;
    /**
     * @var Id
     */
    private $idCliente;
    /**
     * @var float|int|Numeric|string
     */
    private $idEstado;
    /**
     * @var float|int|Numeric|string
     */
    private $registraVehiculo;

    /**
     * TipoEgreso_S constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Numeric $registraVehiculo
     * @param Numeric $registraPersonal
     * @param Numeric $registraRuta
     * @param Id $idCliente
     * @param Numeric $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Numeric $registraVehiculo,
        Numeric $registraPersonal,
        Numeric $registraRuta,
        Id $idCliente,
        Numeric $idEstado,
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->registraPersonal = $registraPersonal;
        $this->registraRuta = $registraRuta;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->registraVehiculo = $registraVehiculo;
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
