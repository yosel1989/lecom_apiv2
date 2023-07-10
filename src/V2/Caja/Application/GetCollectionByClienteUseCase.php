<?php

declare(strict_types=1);

namespace Src\V2\Caja\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;

final class GetCollectionByClienteUseCase
{
    private CajaRepositoryContract $repository;

    public function __construct(CajaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
