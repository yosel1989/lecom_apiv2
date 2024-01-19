<?php

declare(strict_types=1);

namespace Src\V2\EgresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoCategoria\Domain\Contracts\EgresoCategoriaRepositoryContract;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaShortList;

final class GetListByClienteUseCase
{
    private EgresoCategoriaRepositoryContract $repository;

    public function __construct(EgresoCategoriaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): EgresoCategoriaShortList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
