<?php


namespace Src\General\Vehicle\Domain\Contracts;

use Src\Auth\User\Domain\ValueObjects\UserId;
use Src\General\Vehicle\Domain\ValueObjects\VehicleId;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdClient;
use Src\General\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\General\Vehicle\Domain\Vehicle;

interface VehicleRepositoryContract
{
    public function find( VehicleId $id ): ?Vehicle;

    public function getVehiclesByUser(UserId $userId): array;
    public function findByPlate(VehiclePlate $plate, VehicleIdClient $idClient):  ?Vehicle;

    public function findWithRelations( VehicleId $id , array $relations ): ?Vehicle;
}
