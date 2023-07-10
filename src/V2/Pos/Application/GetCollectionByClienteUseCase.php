<?php

declare(strict_types=1);

namespace Src\V2\Pos\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Pos\Domain\Contracts\PosRepositoryContract;

final class GetCollectionByClienteUseCase
{
    private PosRepositoryContract $repository;

    public function __construct(PosRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
