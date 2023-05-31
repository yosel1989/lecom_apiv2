<?php

declare(strict_types=1);

namespace Src\TransportePersonal\Ruta\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class RutaVehiculo
{
    /**
     * @var Id
     */
    private $idRuta;
    /**
     * @var Text
     */
    private $ruta;
    /**
     * @var Id
     */
    private $idVehiculo;

    /**
     * @var Text
     */
    private $vehiculo;


    /**
     * RutaVehiculo constructor.
     * @param Id $idRuta
     * @param Id $idVehiculo
     */
    public function __construct(
        Id $idRuta,
        Id $idVehiculo
    )
    {

        $this->idRuta = $idRuta;
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

}
