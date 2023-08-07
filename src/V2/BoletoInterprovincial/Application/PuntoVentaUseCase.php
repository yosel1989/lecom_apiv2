<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class PuntoVentaUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idSede,
        string $idRuta,
        string $idParadero,
        float $precio,
        int $idTipoDocumento,
        string $numeroDocumento,
        string $nombre,
        ?string $direccion,
        string $idUsuario
    ): void
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false, 'El id de la sede no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false, 'El id de la ruta no tiene el formato correcto');
        $_idParadero = new Id($idParadero,false, 'El id del paradero no tiene el formato correcto');
        $_precio = new NumericFloat($precio);
        $_idTipoDocumento = new NumericInteger($idTipoDocumento);
        $_numeroDocumento = new Text($numeroDocumento,false, -1, '');
        $_nombre = new Text($nombre,false, -1, '');
        $_direccion = new Text($direccion,true, -1, '');
        $_idUsuario = new Id($idUsuario,false, 'El id del usuario no tiene el formato correcto');

        $this->repository->puntoVenta(
            $_idCliente,
            $_idSede,
            $_idRuta,
            $_idParadero,
            $_precio,
            $_idTipoDocumento,
            $_numeroDocumento,
            $_nombre,
            $_direccion,
            $_idUsuario
        );
    }
}
