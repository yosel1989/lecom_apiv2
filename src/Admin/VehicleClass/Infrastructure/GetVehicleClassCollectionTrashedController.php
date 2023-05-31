<?php


namespace Src\Admin\VehicleClass\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleClass\Application\GetVehicleClassCollectionTrashedUseCase;
use Src\Admin\VehicleClass\Infrastructure\Repositories\EloquentVehicleClassRepository;

final class GetVehicleClassCollectionTrashedController
{
    private $repository;

    public function __construct(EloquentVehicleClassRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $getVehicleClassCollectionTrashedUseCase = new GetVehicleClassCollectionTrashedUseCase($this->repository);
        return $getVehicleClassCollectionTrashedUseCase->__invoke();
    }
}
