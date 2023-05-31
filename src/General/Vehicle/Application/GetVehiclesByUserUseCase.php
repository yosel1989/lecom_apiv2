<?php

declare(strict_types=1);

namespace Src\General\Vehicle\Application;

use Src\Auth\User\Domain\ValueObjects\UserId;
use Src\General\Vehicle\Domain\Contracts\VehicleRepositoryContract;

final class GetVehiclesByUserUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct(VehicleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idClient): array
    {
        $id_client = new UserId($idClient);
        return $this->repository->getVehiclesByUser($id_client);
    }
}
