<?php


namespace Src\Admin\VehicleBrand\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleBrand\Application\GetVehicleBrandCollectionUseCase;
use Src\Admin\VehicleBrand\Infrastructure\Repositories\EloquentVehicleBrandRepository;

final class GetVehicleBrandCollectionController
{
    private $repository;

    public function __construct(EloquentVehicleBrandRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $getVehicleBrandCollectionUseCase = new GetVehicleBrandCollectionUseCase($this->repository);
        return $getVehicleBrandCollectionUseCase->__invoke();
    }
}
