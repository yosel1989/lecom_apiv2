<?php

declare(strict_types=1);

namespace Src\V2\PerfilModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\PerfilModuloMenu\Domain\Contracts\PerfilModuloMenuRepositoryContract;

final class GetCollectionByClientePerfilUseCase
{
    private PerfilModuloMenuRepositoryContract $repository;

    public function __construct(PerfilModuloMenuRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idPerfil, int $idModulo): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idPerfil = new Id($idPerfil,false, 'El id del perfil no tiene el formato correcto');
        $_idModulo = new NumericInteger($idModulo);
        return $this->repository->collectionByClientePerfil($_idCliente, $_idPerfil, $_idModulo);
    }
}
