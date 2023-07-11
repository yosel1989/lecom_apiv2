<?php

declare(strict_types=1);

namespace Src\V2\Destino\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Destino\Domain\Contracts\DestinoRepositoryContract;

final class GetListByClienteUseCase
{
    private DestinoRepositoryContract $repository;

    public function __construct(DestinoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
