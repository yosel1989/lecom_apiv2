<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;

final class GetVehicleCollectionByClientUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct(VehicleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idClient): array
    {
        $id_client = new ClientId($idClient);
        return $this->repository->collectionByClient($id_client);
    }
}
