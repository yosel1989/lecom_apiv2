<?php

declare(strict_types=1);

namespace Src\V2\Sede\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Sede\Domain\Contracts\SedeRepositoryContract;

final class GetCollectionByClienteUseCase
{
    private SedeRepositoryContract $repository;

    public function __construct(SedeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
