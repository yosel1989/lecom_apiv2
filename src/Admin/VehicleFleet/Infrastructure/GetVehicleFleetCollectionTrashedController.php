<?php


namespace Src\Admin\VehicleFleet\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleFleet\Application\GetVehicleFleetCollectionTrashedByClientUseCase;
use Src\Admin\VehicleFleet\Infrastructure\Repositories\EloquentVehicleFleetRepository;

final class GetVehicleFleetCollectionTrashedController
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
        $GetVehicleFleetCollectionTrashedByClientUseCase = new GetVehicleFleetCollectionTrashedByClientUseCase($this->repository);
        return $GetVehicleFleetCollectionTrashedByClientUseCase->__invoke($idClient);
    }
}
