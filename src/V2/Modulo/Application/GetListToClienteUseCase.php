<?php

declare(strict_types=1);

namespace Src\V2\Modulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Modulo\Domain\Contracts\ModuloRepositoryContract;

final class GetListToClienteUseCase
{
    private ModuloRepositoryContract $repository;

    public function __construct(ModuloRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente
    ): array
    {
        $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listToCliente($_idCliente);
    }
}
