<?php

namespace Src\V2\Ruta\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var RutaRepositoryContract
     */
    private RutaRepositoryContract $repository;

    public function __construct( RutaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idRuta,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idRuta = new Id($idRuta,false,'El id del Ruta no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idRuta,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
