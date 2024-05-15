<?php

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var VehiculoRepositoryContract
     */
    private VehiculoRepositoryContract $repository;

    public function __construct( VehiculoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $placa,
        string $unidad,
        string $idCliente,
        int $numAsientos,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_placa = new Text($placa,false, 7,'La placa excede los 7 caracteres');
        $_unidad = new Text($unidad,false, 10,'La unidad excede los 10 caracteres');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_numAsientos = new NumericInteger($numAsientos);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_placa,
            $_unidad,
            $_idCliente,
            $_numAsientos,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
