<?php

declare(strict_types=1);

namespace Src\Older\Vehiculo\Domain;


use Src\Older\Vehiculo\Domain\ValueObjects\VehiculoId;
use Src\Older\Vehiculo\Domain\ValueObjects\VehiculoPlaca;

final class Vehiculo
{
    /**
     * @var VehiculoId
     */
    private $id;
    /**
     * @var VehiculoPlaca
     */
    private $placa;

    /**
     * Vehiculo constructor.
     * @param VehiculoId $id
     * @param VehiculoPlaca $placa
     */
    public function __construct(
        VehiculoId $id,
        VehiculoPlaca $placa
    )
    {
        $this->id = $id;
        $this->placa = $placa;
    }

    /**
     * @return VehiculoId
     */
    public function getId(): VehiculoId
    {
        return $this->id;
    }

    /**
     * @return VehiculoPlaca
     */
    public function getPlaca(): VehiculoPlaca
    {
        return $this->placa;
    }


}
