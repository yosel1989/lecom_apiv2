<?php

namespace Src\V2\Personal\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Personal\Domain\Contracts\PersonalRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var PersonalRepositoryContract
     */
    private PersonalRepositoryContract $repository;

    public function __construct( PersonalRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idPersonal,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idPersonal = new Id($idPersonal,false,'El id del vehiculo no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idPersonal,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
