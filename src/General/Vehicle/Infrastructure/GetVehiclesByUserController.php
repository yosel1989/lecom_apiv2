<?php


namespace Src\General\Vehicle\Infrastructure;

use Src\General\Vehicle\Application\GetVehiclesByUserUseCase;
use Src\General\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class GetVehiclesByUserController
{
    private $repository;

    public function __construct(EloquentVehicleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $idClient
     * @return mixed
     */
    public function __invoke( string $idClient )
    {
        $getVehiclesByUserUseCase = new GetVehiclesByUserUseCase($this->repository);
        return $getVehiclesByUserUseCase->__invoke($idClient);
    }
}
