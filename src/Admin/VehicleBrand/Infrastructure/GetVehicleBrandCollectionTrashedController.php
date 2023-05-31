<?php


namespace Src\Admin\VehicleBrand\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleBrand\Application\GetVehicleBrandCollectionTrashedUseCase;
use Src\Admin\VehicleBrand\Infrastructure\Repositories\EloquentVehicleBrandRepository;

final class GetVehicleBrandCollectionTrashedController
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
        $getVehicleBrandCollectionTrashedUseCase = new GetVehicleBrandCollectionTrashedUseCase($this->repository);
        return $getVehicleBrandCollectionTrashedUseCase->__invoke();
    }
}
