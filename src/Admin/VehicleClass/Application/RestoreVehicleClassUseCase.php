<?php

declare(strict_types=1);

namespace Src\Admin\VehicleClass\Application;

use Src\Admin\VehicleClass\Domain\Contracts\VehicleClassRepositoryContract;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassId;

final class RestoreVehicleClassUseCase
{
    /**
     * @var VehicleClassRepositoryContract
     */
    private $repository;

    public function __construct(VehicleClassRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $b_id = new VehicleClassId($value);
                $this->repository->restore($b_id);
            }

        }else{

            $b_id = new VehicleClassId($id);
            $this->repository->restore($b_id);

        }

    }
}
