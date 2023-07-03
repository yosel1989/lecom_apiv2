<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;
use Src\V2\Vehiculo\Domain\Vehiculo;

final class FindByIdUseCase
{
    private VehiculoRepositoryContract $repository;

    public function __construct(VehiculoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idVehiculo): Vehiculo
    {
        $_idVehiculo = new Id($idVehiculo,false, 'El id del vehiculo no tiene el formato correcto');
        return $this->repository->find($_idVehiculo);
    }
}
