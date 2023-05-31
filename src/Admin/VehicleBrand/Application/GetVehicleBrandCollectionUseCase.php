<?php

declare(strict_types=1);

namespace Src\Admin\VehicleBrand\Application;

use Src\Admin\VehicleBrand\Domain\Contracts\VehicleBrandRepositoryContract;

final class GetVehicleBrandCollectionUseCase
{
    /**
     * @var VehicleBrandRepositoryContract
     */
    private $repository;

    public function __construct(VehicleBrandRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
