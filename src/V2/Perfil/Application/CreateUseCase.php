<?php

namespace Src\V2\Perfil\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Perfil\Domain\Contracts\PerfilRepositoryContract;

final class CreateUseCase
{
    /**
     * @var PerfilRepositoryContract
     */
    private PerfilRepositoryContract $repository;

    public function __construct( PerfilRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $nombre,
        int $idNivelUsuario,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'La nombre del perfil excede los 100 caracteres');
        $_idNivelUsuario = new NumericInteger($idNivelUsuario);
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_idNivelUsuario,
            $_idCliente,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
