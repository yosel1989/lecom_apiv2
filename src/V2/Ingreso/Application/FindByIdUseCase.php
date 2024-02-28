<?php

declare(strict_types=1);

namespace Src\V2\Ingreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Ingreso\Domain\Contracts\IngresoRepositoryContract;
use Src\V2\Ingreso\Domain\Ingreso;

final class FindByIdUseCase
{
    private IngresoRepositoryContract $repository;

    public function __construct(IngresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idIngreso): Ingreso
    {
        $_idIngreso = new Id($idIngreso,false, 'El id del Ingreso no tiene el formato correcto');
        return $this->repository->find($_idIngreso);
    }
}
