<?php

namespace Src\Admin\VehicleClass\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\VehicleClass\Application\GetVehicleClassCollectionUseCase;
use Src\Admin\VehicleClass\Infrastructure\Repositories\EloquentVehicleClassRepository;

final class GetVehicleClassCollectionController
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
        $getVehicleClassCollectionUseCase = new GetVehicleClassCollectionUseCase($this->repository);
        return $getVehicleClassCollectionUseCase->__invoke();
    }
}
