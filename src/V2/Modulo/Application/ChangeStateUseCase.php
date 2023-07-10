<?php

namespace Src\V2\Modulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Modulo\Domain\Contracts\ModuloRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var ModuloRepositoryContract
     */
    private ModuloRepositoryContract $repository;

    public function __construct( ModuloRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idModulo,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idModulo = new Id($idModulo,false,'El id del modulo no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idModulo,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
