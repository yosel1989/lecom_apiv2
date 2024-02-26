<?php

declare(strict_types=1);

namespace Src\V2\IngresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\IngresoCategoria\Domain\Contracts\IngresoCategoriaRepositoryContract;
use Src\V2\IngresoCategoria\Domain\IngresoCategoriaList;

final class GetCollectionByClienteUseCase
{
    private IngresoCategoriaRepositoryContract $repository;

    public function __construct(IngresoCategoriaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): IngresoCategoriaList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
