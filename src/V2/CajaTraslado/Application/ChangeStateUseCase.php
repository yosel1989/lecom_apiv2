<?php

namespace Src\V2\CajaTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;

final class ChangeStateUseCase
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
        string $idCajaTraslado,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idCajaTraslado = new Id($idCajaTraslado,false,'El id del CajaTraslado no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idCajaTraslado,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
