<?php

declare(strict_types=1);

namespace Src\Admin\VehicleModel\Application;

use Src\Admin\VehicleModel\Domain\Contracts\VehicleModelRepositoryContract;

final class GetVehicleModelCollectionUseCase
{
    /**
     * @var VehicleModelRepositoryContract
     */
    private $repository;

    public function __construct(VehicleModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
