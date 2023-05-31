<?php

declare(strict_types=1);

namespace Src\Admin\VehicleBrand\Application;

use Src\Admin\VehicleBrand\Domain\Contracts\VehicleBrandRepositoryContract;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;

final class TrashVehicleBrandUseCase
{
    /**
     * @var VehicleBrandRepositoryContract
     */
    private $repository;

    public function __construct(VehicleBrandRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $b_id = new VehicleBrandId($value);
                $this->repository->trash($b_id);
            }

        }else{

            $b_id = new VehicleBrandId($id);
            $this->repository->trash($b_id);

        }

    }
}
