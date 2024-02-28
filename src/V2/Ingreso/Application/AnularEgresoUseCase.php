<?php

namespace Src\V2\Ingreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Ingreso\Domain\Contracts\IngresoRepositoryContract;

final class AnularIngresoUseCase
{
    /**
     * @var IngresoRepositoryContract
     */
    private IngresoRepositoryContract $repository;

    public function __construct( IngresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idIngreso,
        string $idUsuarioModifico
    ): void
    {
        $_idIngreso = new Id($idIngreso,false,'El id del ingreso no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');

        $this->repository->anular(
            $_idIngreso,
            $_idUsuarioModifico
        );

    }
}
