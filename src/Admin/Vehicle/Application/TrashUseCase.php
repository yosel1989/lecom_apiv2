<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Application;

use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;

final class TrashUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct(VehicleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new VehicleId($value);
                $this->repository->trash($g_id);
            }

        }else{

            $g_id = new VehicleId($id);
            $this->repository->trash($g_id);

        }

    }
}
