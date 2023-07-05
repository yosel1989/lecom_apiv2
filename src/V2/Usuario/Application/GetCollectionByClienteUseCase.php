<?php

declare(strict_types=1);

namespace Src\V2\Usuario\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Usuario\Domain\Contracts\UsuarioRepositoryContract;

final class GetCollectionByClienteUseCase
{
    private UsuarioRepositoryContract $repository;

    public function __construct(UsuarioRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
