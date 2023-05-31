<?php

declare(strict_types=1);

namespace Src\General\Vehicle\Application;

use Src\General\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\General\Vehicle\Domain\ValueObjects\VehicleId;
use Src\General\Vehicle\Domain\Vehicle;

final class GetVehicleUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct(VehicleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $vehicleId): ?Vehicle
    {
        $id = new VehicleId($vehicleId);
        return $this->repository->find($id);
    }
}
