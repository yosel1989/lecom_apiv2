<?php


namespace Src\Admin\VehicleModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleModel\Application\GetCollectionByBrandUseCase;
use Src\Admin\VehicleModel\Infrastructure\Repositories\EloquentVehicleModelRepository;

final class GetCollectionByBrandController
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
        $idBrand = $request->id;
        $getCollectionByBrandUseCase = new GetCollectionByBrandUseCase($this->repository);
        return $getCollectionByBrandUseCase->__invoke($idBrand);
    }
}
