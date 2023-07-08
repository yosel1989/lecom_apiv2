<?php

declare(strict_types=1);

namespace Src\V2\Perfil\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Perfil\Domain\Contracts\PerfilRepositoryContract;

final class GetListByClienteUseCase
{
    private PerfilRepositoryContract $repository;

    public function __construct(PerfilRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
