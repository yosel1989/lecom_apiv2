<?php

namespace Src\V2\BoletoPrecio\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoPrecio\Domain\Contracts\BoletoPrecioRepositoryContract;

final class ChangePredeterminadoUseCase
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
        string $idRuta,
        string $idUsuarioRegistro
    ): void
    {
        $_idBoletoPrecio = new Id($idBoletoPrecio,false,'El id del destino no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false,'El id de la ruta no tiene el formato correcto');
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->changePredeterminado(
            $_idBoletoPrecio,
            $_idRuta,
            $_idUsuarioRegistro
        );

    }
}
