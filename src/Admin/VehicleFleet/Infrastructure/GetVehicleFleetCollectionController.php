<?php


namespace Src\Admin\VehicleFleet\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleFleet\Application\GetVehicleFleetCollectionByClientUseCase;
use Src\Admin\VehicleFleet\Infrastructure\Repositories\EloquentVehicleFleetRepository;

final class GetVehicleFleetCollectionController
{
    private $repository;

    public function __construct(EloquentVehicleFleetRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $idClient = $request->id;
        $GetVehicleFleetCollectionByClientUseCase = new GetVehicleFleetCollectionByClientUseCase($this->repository);
        return $GetVehicleFleetCollectionByClientUseCase->__invoke($idClient);
    }
}
