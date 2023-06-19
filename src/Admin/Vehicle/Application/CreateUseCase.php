<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Application;

use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;
use Src\Admin\Vehicle\Domain\Vehicle;
use Src\Core\Domain\ValueObjects\Id;

final class CreateUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct( VehicleRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $placa,
        string $unidad,
        string $idCliente,
        ?string $idCategoria,
        ?string $idMarca,
        ?string $idModelo,
        ?string $idClase,
        ?string $idFlota
    ): ?Vehicle
    {
        return $this->repository->create(
            new Id( $id ),
            new VehiclePlate( $placa ),
            new VehicleUnit( $unidad ),
            new Id( $idCliente, true ),
            new Id( $idCategoria, true ),
            new Id( $idMarca, true ),
            new Id( $idModelo, true ),
            new Id( $idClase, true ),
            new Id( $idFlota, true )
        );
    }
}
