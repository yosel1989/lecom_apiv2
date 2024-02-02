<?php

namespace Src\V2\TipoPersonal\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\TipoPersonal\Domain\Contracts\TipoPersonalRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var TipoPersonalRepositoryContract
     */
    private TipoPersonalRepositoryContract $repository;

    public function __construct( TipoPersonalRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idTipoPersonal,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idTipoPersonal = new Id($idTipoPersonal,false,'El id del TipoPersonal no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idTipoPersonal,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
