<?php

namespace Src\V2\ClienteModulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ClienteModulo\Domain\Contracts\ClienteModuloRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var ClienteModuloRepositoryContract
     */
    private ClienteModuloRepositoryContract $repository;

    public function __construct( ClienteModuloRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idClienteModulo,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idClienteModulo = new Id($idClienteModulo,false,'El id del perfil no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del perfil excede los 100 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idClienteModulo,
            $_nombre,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
