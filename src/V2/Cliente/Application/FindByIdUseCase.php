<?php

declare(strict_types=1);

namespace Src\V2\Cliente\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Cliente\Domain\Contracts\ClienteRepositoryContract;
use Src\V2\Cliente\Domain\Cliente;

final class FindByIdUseCase
{
    private ClienteRepositoryContract $repository;

    public function __construct(ClienteRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): Cliente
    {
        $_idCliente = new Id($idCliente,false, 'El id del vehiculo no tiene el formato correcto');
        return $this->repository->find($_idCliente);
    }
}
