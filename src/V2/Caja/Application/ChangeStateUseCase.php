<?php

namespace Src\V2\Caja\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var CajaRepositoryContract
     */
    private CajaRepositoryContract $repository;

    public function __construct( CajaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCaja,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idCaja = new Id($idCaja,false,'El id del caja no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idCaja,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
