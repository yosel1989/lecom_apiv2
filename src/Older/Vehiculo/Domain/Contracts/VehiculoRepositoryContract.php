<?php


namespace Src\Older\Vehiculo\Domain\Contracts;


use Src\Older\Vehiculo\Domain\ValueObjects\VehiculoId;
use Src\Older\Vehiculo\Domain\Vehiculo;

interface VehiculoRepositoryContract
{

    public function find( VehiculoId $id ): ?Vehiculo;

}
