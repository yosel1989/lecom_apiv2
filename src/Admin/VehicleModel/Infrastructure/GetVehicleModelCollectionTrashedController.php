<?php


namespace Src\Admin\VehicleModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleModel\Application\GetVehicleModelCollectionTrashedUseCase;
use Src\Admin\VehicleModel\Infrastructure\Repositories\EloquentVehicleModelRepository;

final class GetVehicleModelCollectionTrashedController
{
    private $repository;

    public function __construct(EloquentVehicleModelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $getVehicleModelCollectionTrashedUseCase = new GetVehicleModelCollectionTrashedUseCase($this->repository);
        return $getVehicleModelCollectionTrashedUseCase->__invoke();
    }
}
