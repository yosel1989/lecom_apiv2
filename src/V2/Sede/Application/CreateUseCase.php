<?php

namespace Src\V2\Sede\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Sede\Domain\Contracts\SedeRepositoryContract;

final class CreateUseCase
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
        string $nombre,
        ?string $direccion,
        string $idCliente,
        ?string $codigo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la sede excede los 100 caracteres');
        $_direccion = new Text($direccion,true, 150,'La direccion de la sede excede los 150 caracteres');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_codigo = new Text($codigo,true, 5,'El código  excede los 5 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_direccion,
            $_idCliente,
            $_codigo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
