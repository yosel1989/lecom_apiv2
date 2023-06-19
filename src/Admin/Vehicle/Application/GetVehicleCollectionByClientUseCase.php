<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Application;

use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\Core\Domain\ValueObjects\Id;

final class GetVehicleCollectionByClientUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct(VehicleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente);
        return $this->repository->collectionByClient($_idCliente);
    }
}
