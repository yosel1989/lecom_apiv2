<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;

final class GetListByClienteUseCase
{
    private VehiculoRepositoryContract $repository;

    public function __construct(VehiculoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
