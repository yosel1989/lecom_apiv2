<?php

namespace Src\V2\Sede\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Sede\Domain\Contracts\SedeRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var SedeRepositoryContract
     */
    private SedeRepositoryContract $repository;

    public function __construct( SedeRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idSede,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idSede = new Id($idSede,false,'El id del sede no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idSede,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
