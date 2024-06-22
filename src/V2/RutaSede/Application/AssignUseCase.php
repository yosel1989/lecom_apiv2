<?php

namespace Src\V2\RutaSede\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\RutaSede\Domain\Contracts\RutaSedeRepositoryContract;

final class AssignUseCase
{
    /**
     * @var RutaSedeRepositoryContract
     */
    private RutaSedeRepositoryContract $repository;

    public function __construct( RutaSedeRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idRuta,
        array $sedes,
        string $idUsuario
    ): void
    {
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false,'El id de la ruta no tiene el formato correcto');
        $_sedes = $sedes;
        $_idUsuario = new Id($idUsuario,false,'El id del usuario no tiene el formato correcto');

        $this->repository->assign(
            $_idCliente,
            $_idRuta,
            $_sedes,
            $_idUsuario
        );

    }
}
