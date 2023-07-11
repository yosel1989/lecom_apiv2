<?php

namespace Src\V2\Destino\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Destino\Domain\Contracts\DestinoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var DestinoRepositoryContract
     */
    private DestinoRepositoryContract $repository;

    public function __construct( DestinoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $nombre,
        float $precioBase,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la destino excede los 100 caracteres');
        $_precioBase = new NumericFloat($precioBase);
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_precioBase,
            $_idCliente,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
