<?php

namespace Src\V2\Destino\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Destino\Domain\Contracts\DestinoRepositoryContract;

final class UpdateUseCase
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
        string $idDestino,
        string $nombre,
        float $precioBase,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idDestino = new Id($idDestino,false,'El id del destino no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del destino excede los 100 caracteres');
        $_precioBase = new NumericFloat($precioBase);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idDestino,
            $_nombre,
            $_precioBase,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
