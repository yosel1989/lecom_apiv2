<?php


namespace Src\Admin\VehicleFleet\Domain\Contracts;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetId;
use Src\Admin\VehicleFleet\Domain\VehicleFleet;

interface VehicleFleetRepositoryContract
{
    public function create( VehicleFleetId $id ): ?VehicleFleet;

    public function find( VehicleFleetId $id ): ?VehicleFleet;

    public function collectionByCLient( ClientId $clientId ): array;

    public function collectionTrashedByClient( ClientId $clientId ): array;
}
