<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdBrand;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdCategory;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdClass;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdFleet;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdModel;
use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;
use Src\Admin\Vehicle\Domain\Vehicle;

final class CreateUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct( VehicleRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $plate,
        string $unit,
        string $client,
        ?string $categoria,
        ?string $brand,
        ?string $model,
        ?string $class,
        ?string $fleet
    ): ?Vehicle
    {
        return $this->repository->create(
            new VehicleId( $id ),
            new VehiclePlate( $plate ),
            new VehicleUnit( $unit ),
            new ClientId( $client ),
            new VehicleIdCategory( $categoria ),
            new VehicleIdBrand( $brand ),
            new VehicleIdModel( $model ),
            new VehicleIdClass( $class ),
            new VehicleIdFleet( $fleet )
        );
    }
}
