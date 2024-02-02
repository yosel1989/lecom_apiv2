<?php

namespace Src\V2\TipoPersonal\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\TipoPersonal\Domain\Contracts\TipoPersonalRepositoryContract;

final class UpdateUseCase
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
        string $id,
        string $idCliente,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_id = new Id($id,true,'El id no tiene el formato correcto');
        $_idCliente = new Id($idCliente,true,'El id del cliente no tiene el formato correcto');
        $_nombre = new Text($nombre, false,150,'El nombre excede los 150 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_id,
            $_idCliente,
            $_nombre,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
