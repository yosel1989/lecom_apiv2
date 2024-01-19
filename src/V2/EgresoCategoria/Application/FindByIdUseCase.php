<?php

declare(strict_types=1);

namespace Src\V2\EgresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoCategoria\Domain\Contracts\EgresoCategoriaRepositoryContract;
use Src\V2\EgresoCategoria\Domain\EgresoCategoria;

final class FindByIdUseCase
{
    private EgresoCategoriaRepositoryContract $repository;

    public function __construct(EgresoCategoriaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idEgresoCategoria): EgresoCategoria
    {
        $_idEgresoCategoria = new Id($idEgresoCategoria,false, 'El id del EgresoCategoria no tiene el formato correcto');
        return $this->repository->find($_idEgresoCategoria);
    }
}
