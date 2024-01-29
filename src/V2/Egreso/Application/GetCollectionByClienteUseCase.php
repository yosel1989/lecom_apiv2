<?php

declare(strict_types=1);

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\V2\Egreso\Domain\EgresoList;

final class GetCollectionByClienteUseCase
{
    private EgresoRepositoryContract $repository;

    public function __construct(EgresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): EgresoList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
