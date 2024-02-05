<?php

namespace Src\V2\EgresoDetalle\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoDetalle\Domain\Contracts\EgresoDetalleRepositoryContract;

final class DeleteByEgresoUseCase
{
    /**
     * @var EgresoDetalleRepositoryContract
     */
    private EgresoDetalleRepositoryContract $repository;

    public function __construct( EgresoDetalleRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEgreso
    ): void
    {

        $_id = new Id($idEgreso,false, 'El id del egreso no tiene el formato correcto');

        $this->repository->deleteByEgreso(
            $_id
        );

    }
}
