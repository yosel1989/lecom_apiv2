<?php

declare(strict_types=1);

namespace Src\V2\Cliente\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Cliente\Domain\Contracts\ClienteRepositoryContract;

final class GetListByClienteUseCase
{
    private ClienteRepositoryContract $repository;

    public function __construct(ClienteRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
