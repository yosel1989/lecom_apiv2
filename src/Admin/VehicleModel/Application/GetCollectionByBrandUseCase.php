<?php

declare(strict_types=1);

namespace Src\Admin\VehicleModel\Application;

use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleModel\Domain\Contracts\VehicleModelRepositoryContract;

final class GetCollectionByBrandUseCase
{
    /**
     * @var VehicleModelRepositoryContract
     */
    private $repository;

    public function __construct(VehicleModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idBrand ): array
    {
        $brand = new VehicleBrandId($idBrand);
        return $this->repository->collectionByBrand( $brand );
    }
}
