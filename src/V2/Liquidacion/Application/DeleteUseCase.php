<?php

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;

final class DeleteUseCase
{
    /**
     * @var LiquidacionRepositoryContract
     */
    private LiquidacionRepositoryContract $repository;

    public function __construct( LiquidacionRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id
    ): void
    {

        $_id = new Id($id,false, 'El id del Liquidacion no tiene el formato correcto');

        $this->repository->delete(
            $_id
        );

    }
}
