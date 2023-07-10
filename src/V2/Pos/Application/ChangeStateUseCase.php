<?php

namespace Src\V2\Pos\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Pos\Domain\Contracts\PosRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var PosRepositoryContract
     */
    private PosRepositoryContract $repository;

    public function __construct( PosRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idPos,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idPos = new Id($idPos,false,'El id del pos no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idPos,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
