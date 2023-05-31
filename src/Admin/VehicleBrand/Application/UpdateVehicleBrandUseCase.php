<?php

declare(strict_types=1);

namespace Src\Admin\VehicleBrand\Application;

use Src\Admin\VehicleBrand\Domain\Contracts\VehicleBrandRepositoryContract;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandName;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;

final class UpdateVehicleBrandUseCase
{
    /**
     * @var VehicleBrandRepositoryContract
     */
    private $repository;

    public function __construct(VehicleBrandRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name ): ?VehicleBrand
    {
        $b_id = new VehicleBrandId($id);
        $b_name = new VehicleBrandName($name);
        return $this->repository->update($b_id,$b_name);
    }
}
