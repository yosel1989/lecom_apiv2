<?php

declare(strict_types=1);

namespace Src\General\Vehicle\Application;

use Src\General\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdClient;
use Src\General\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\General\Vehicle\Domain\Vehicle;

final class GetVehicleByPlateUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct(VehicleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $vehiclePlate, string $idClient): ?Vehicle
    {
        $plate = new VehiclePlate($vehiclePlate);
        $idClient = new VehicleIdClient($idClient);
        return $this->repository->findByPlate($plate, $idClient);
    }
}
