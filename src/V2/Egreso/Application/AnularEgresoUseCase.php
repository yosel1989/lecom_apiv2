<?php

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;

final class AnularEgresoUseCase
{
    /**
     * @var EgresoRepositoryContract
     */
    private EgresoRepositoryContract $repository;

    public function __construct( EgresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEgreso,
        string $idUsuarioModifico
    ): void
    {
        $_idEgreso = new Id($idEgreso,false,'El id del egreso no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');

        $this->repository->anular(
            $_idEgreso,
            $_idUsuarioModifico
        );

    }
}
