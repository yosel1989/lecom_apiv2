<?php

declare(strict_types=1);

namespace Src\V2\Empresa\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Empresa\Domain\Contracts\EmpresaRepositoryContract;

final class GetListByClienteUseCase
{
    private EmpresaRepositoryContract $repository;

    public function __construct(EmpresaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
