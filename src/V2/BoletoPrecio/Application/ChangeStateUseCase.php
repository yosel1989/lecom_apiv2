<?php

namespace Src\V2\BoletoPrecio\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\BoletoPrecio\Domain\Contracts\BoletoPrecioRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var BoletoPrecioRepositoryContract
     */
    private BoletoPrecioRepositoryContract $repository;

    public function __construct( BoletoPrecioRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idBoletoPrecio,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idBoletoPrecio = new Id($idBoletoPrecio,false,'El id del destino no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idBoletoPrecio,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
