<?php

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;

final class ChangeStateUseCase
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
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idVehiculo = new Id($idVehiculo,false,'El id del vehiculo no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idVehiculo,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
