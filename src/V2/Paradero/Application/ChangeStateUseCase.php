<?php

namespace Src\V2\Paradero\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var ParaderoRepositoryContract
     */
    private ParaderoRepositoryContract $repository;

    public function __construct( ParaderoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idParadero,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idParadero = new Id($idParadero,false,'El id del destino no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idParadero,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
