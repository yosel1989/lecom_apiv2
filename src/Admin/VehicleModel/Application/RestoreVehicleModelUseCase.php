<?php

declare(strict_types=1);

namespace Src\Admin\VehicleModel\Application;

use Src\Admin\VehicleModel\Domain\Contracts\VehicleModelRepositoryContract;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelId;

final class RestoreVehicleModelUseCase
{
    /**
     * @var VehicleModelRepositoryContract
     */
    private $repository;

    public function __construct(VehicleModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $b_id = new VehicleModelId($value);
                $this->repository->restore($b_id);
            }

        }else{

            $b_id = new VehicleModelId($id);
            $this->repository->restore($b_id);

        }

    }
}
