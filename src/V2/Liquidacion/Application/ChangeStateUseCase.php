<?php

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;

final class ChangeStateUseCase
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
        string $idLiquidacion,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idLiquidacion = new Id($idLiquidacion,false,'El id del Liquidacion no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idLiquidacion,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
