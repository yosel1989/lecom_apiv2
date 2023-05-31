<?php


namespace Src\Admin\VehicleModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleModel\Application\GetVehicleModelCollectionUseCase;
use Src\Admin\VehicleModel\Infrastructure\Repositories\EloquentVehicleModelRepository;

final class GetVehicleModelCollectionController
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
        $getVehicleModelCollectionUseCase = new GetVehicleModelCollectionUseCase($this->repository);
        return $getVehicleModelCollectionUseCase->__invoke();
    }
}
