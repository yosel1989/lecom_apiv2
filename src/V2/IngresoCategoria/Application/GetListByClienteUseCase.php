<?php

declare(strict_types=1);

namespace Src\V2\IngresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\IngresoCategoria\Domain\Contracts\IngresoCategoriaRepositoryContract;
use Src\V2\IngresoCategoria\Domain\IngresoCategoriaShortList;

final class GetListByClienteUseCase
{
    private IngresoCategoriaRepositoryContract $repository;

    public function __construct(IngresoCategoriaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): IngresoCategoriaShortList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
