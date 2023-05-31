<?php

declare(strict_types=1);

namespace Src\Admin\VehicleModel\Application;

use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleModel\Domain\Contracts\VehicleModelRepositoryContract;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelId;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelName;
use Src\Admin\VehicleModel\Domain\VehicleModel;

final class CreateVehicleModelUseCase
{
    /**
     * @var VehicleModelRepositoryContract
     */
    private $repository;

    public function __construct(VehicleModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name, string $idBrand ): ?VehicleModel
    {
        $s_id = new VehicleModelId($id);
        $s_name = new VehicleModelName($name);
        $b_id = new VehicleBrandId($idBrand);
        return $this->repository->create($s_id,$s_name,$b_id);
    }
}
