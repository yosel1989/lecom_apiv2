<?php

declare(strict_types=1);

namespace Src\V2\EgresoDetalle\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoDetalle\Domain\Contracts\EgresoDetalleRepositoryContract;
use Src\V2\EgresoDetalle\Domain\EgresoDetalleList;

final class GetCollectionByClienteUseCase
{
    private EgresoDetalleRepositoryContract $repository;

    public function __construct(EgresoDetalleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idEgreso): EgresoDetalleList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idEgreso = new Id($idEgreso,false, 'El id del egreso no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente, $_idEgreso);
    }
}
