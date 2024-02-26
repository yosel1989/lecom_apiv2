<?php

declare(strict_types=1);

namespace Src\V2\IngresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\IngresoCategoria\Domain\Contracts\IngresoCategoriaRepositoryContract;
use Src\V2\IngresoCategoria\Domain\IngresoCategoria;

final class FindByIdUseCase
{
    private IngresoCategoriaRepositoryContract $repository;

    public function __construct(IngresoCategoriaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idIngresoCategoria): IngresoCategoria
    {
        $_idIngresoCategoria = new Id($idIngresoCategoria,false, 'El id del categoria no tiene el formato correcto');
        return $this->repository->find($_idIngresoCategoria);
    }
}
