<?php

declare(strict_types=1);

namespace Src\V2\IngresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\IngresoTipo\Domain\Contracts\IngresoTipoRepositoryContract;
use Src\V2\IngresoTipo\Domain\IngresoTipo;

final class FindByIdUseCase
{
    private IngresoTipoRepositoryContract $repository;

    public function __construct(IngresoTipoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idIngresoTipo): IngresoTipo
    {
        $_idIngresoTipo = new Id($idIngresoTipo,false, 'El id del tipo de ingreso no tiene el formato correcto');
        return $this->repository->find($_idIngresoTipo);
    }
}
