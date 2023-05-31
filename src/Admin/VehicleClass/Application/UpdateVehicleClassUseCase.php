<?php

declare(strict_types=1);

namespace Src\Admin\VehicleClass\Application;


use Src\Admin\VehicleClass\Domain\Contracts\VehicleClassRepositoryContract;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassIcon;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassId;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassName;
use Src\Admin\VehicleClass\Domain\VehicleClass;

final class UpdateVehicleClassUseCase
{
    /**
     * @var VehicleClassRepositoryContract
     */
    private $repository;

    public function __construct(VehicleClassRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name, string $icon ): ?VehicleClass
    {
        $c_id = new VehicleClassId($id);
        $c_name = new VehicleClassName($name);
        $c_icon = new VehicleClassIcon($icon);
        return $this->repository->update($c_id,$c_name,$c_icon);
    }
}
