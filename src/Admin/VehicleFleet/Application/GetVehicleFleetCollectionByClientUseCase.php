<?php

declare(strict_types=1);

namespace Src\Admin\VehicleFleet\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\VehicleFleet\Domain\Contracts\VehicleFleetRepositoryContract;

final class GetVehicleFleetCollectionByClientUseCase
{
    /**
     * @var VehicleFleetRepositoryContract
     */
    private $repository;

    public function __construct(VehicleFleetRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idClient ): array
    {
        $client = new ClientId($idClient);
        return $this->repository->collectionByCLient($client);
    }
}
