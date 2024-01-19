<?php

declare(strict_types=1);

namespace Src\V2\EgresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoTipo\Domain\Contracts\EgresoTipoRepositoryContract;
use Src\V2\EgresoTipo\Domain\EgresoTipo;

final class FindByIdUseCase
{
    private EgresoTipoRepositoryContract $repository;

    public function __construct(EgresoTipoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idEgresoTipo): EgresoTipo
    {
        $_idEgresoTipo = new Id($idEgresoTipo,false, 'El id del EgresoTipo no tiene el formato correcto');
        return $this->repository->find($_idEgresoTipo);
    }
}
