<?php

declare(strict_types=1);

namespace Src\Admin\VehicleClass\Application;

use Src\Admin\VehicleClass\Domain\Contracts\VehicleClassRepositoryContract;

final class GetVehicleClassCollectionUseCase
{
    /**
     * @var VehicleClassRepositoryContract
     */
    private $repository;

    public function __construct(VehicleClassRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
