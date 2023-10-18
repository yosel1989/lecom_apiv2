<?php

namespace Src\V2\Paradero\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var ParaderoRepositoryContract
     */
    private ParaderoRepositoryContract $repository;

    public function __construct( ParaderoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $nombre,
//        float $precioBase,
        float $latitud,
        float $longitud,
        int $idTipoRuta,
//        string $idRuta,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la destino excede los 100 caracteres');
//        $_precioBase = new NumericFloat($precioBase);
        $_latitud = new NumericFloat($latitud);
        $_longitud = new NumericFloat($longitud);
        $_idTipoRuta = new NumericInteger($idTipoRuta);
//        $_idRuta = new Id($idRuta,false,'El id de la ruta no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
//            $_precioBase,
            $_latitud,
            $_longitud,
            $_idTipoRuta,
//            $_idRuta,
            $_idCliente,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
