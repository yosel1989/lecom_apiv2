<?php

namespace Src\V2\CajaTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;

final class DeleteUseCase
{
    /**
     * @var CajaTrasladoRepositoryContract
     */
    private CajaTrasladoRepositoryContract $repository;

    public function __construct( CajaTrasladoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id
    ): void
    {

        $_id = new Id($id,false, 'El id del CajaTraslado no tiene el formato correcto');

        $this->repository->delete(
            $_id
        );

    }
}
