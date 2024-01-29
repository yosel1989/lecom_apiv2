<?php

declare(strict_types=1);

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\V2\Egreso\Domain\Egreso;

final class FindByIdUseCase
{
    private EgresoRepositoryContract $repository;

    public function __construct(EgresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idEgreso): Egreso
    {
        $_idEgreso = new Id($idEgreso,false, 'El id del Egreso no tiene el formato correcto');
        return $this->repository->find($_idEgreso);
    }
}
