<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;
use Src\V2\Vehiculo\Domain\VehiculoShortList;

final class GetListByClienteArrayUseCase
{
    private VehiculoRepositoryContract $repository;

    public function __construct(VehiculoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, array $idVehiculos): VehiculoShortList
    {
        $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByClienteArray($_idCliente, $idVehiculos);
    }
}
