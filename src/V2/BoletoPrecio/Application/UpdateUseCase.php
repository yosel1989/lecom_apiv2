<?php

namespace Src\V2\BoletoPrecio\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoPrecio\Domain\Contracts\BoletoPrecioRepositoryContract;

final class UpdateUseCase
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
        string $idParaderoOrigen,
        string $idParaderoDestino,
        float $precioBase,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idBoletoPrecio = new Id($idBoletoPrecio,false,'El id del viaje no tiene el formato correcto');
        $_idParaderoOrigen = new Id($idParaderoOrigen,false,'El id del paradero origen  no tiene el formato correcto');
        $_idParaderoDestino = new Id($idParaderoDestino,false,'El id del paradero destino  no tiene el formato correcto');
        $_precioBase = new NumericFloat($precioBase);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idBoletoPrecio,
            $_idParaderoOrigen,
            $_idParaderoDestino,
            $_precioBase,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
