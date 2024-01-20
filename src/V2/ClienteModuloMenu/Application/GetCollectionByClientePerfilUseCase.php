<?php

declare(strict_types=1);

namespace Src\V2\ClienteModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\ClienteModuloMenu\Domain\Contracts\ClienteModuloMenuRepositoryContract;

final class GetCollectionByClientePerfilUseCase
{
    private ClienteModuloMenuRepositoryContract $repository;

    public function __construct(ClienteModuloMenuRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, int $idModulo): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idModulo = new NumericInteger($idModulo);
        return $this->repository->collectionByCliente($_idCliente, $_idModulo);
    }
}
