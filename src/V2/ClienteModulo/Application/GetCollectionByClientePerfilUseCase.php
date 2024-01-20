<?php

declare(strict_types=1);

namespace Src\V2\ClienteModulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ClienteModulo\Domain\Contracts\ClienteModuloRepositoryContract;

final class GetCollectionByClientePerfilUseCase
{
    private ClienteModuloRepositoryContract $repository;

    public function __construct(ClienteModuloRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idPerfil): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idPerfil = new Id($idPerfil,false, 'El id del perfil no tiene el formato correcto');
        return $this->repository->collectionByClientePerfil($_idCliente, $_idPerfil);
    }
}
