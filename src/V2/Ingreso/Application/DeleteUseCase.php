<?php

namespace Src\V2\Ingreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Ingreso\Domain\Contracts\IngresoRepositoryContract;

final class DeleteUseCase
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
        string $id
    ): void
    {

        $_id = new Id($id,false, 'El id del ingreso no tiene el formato correcto');

        $this->repository->delete(
            $_id
        );

    }
}
