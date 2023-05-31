<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Application;

use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\Vehicle;

final class FindUseCase
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
        string $id
    ): ?Vehicle
    {
        return $this->repository->find(
            new VehicleId( $id )
        );
    }
}
