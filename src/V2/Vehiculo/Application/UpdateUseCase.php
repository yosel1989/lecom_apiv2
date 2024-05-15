<?php

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;

final class UpdateUseCase
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
        string $idVehiculo,
        string $placa,
        string $unidad,
        int $numAsientos,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idVehiculo = new Id($idVehiculo,false,'El id del vehiculo no tiene el formato correcto');
        $_placa = new Text($placa,false, 7,'La placa excede los 7 caracteres');
        $_unidad = new Text($unidad,false, 10,'La unidad excede los 10 caracteres');
        $_numAsientos = new NumericInteger($numAsientos);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idVehiculo,
            $_placa,
            $_unidad,
            $_numAsientos,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
