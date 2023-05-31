<?php


namespace Src\Admin\VehicleBrand\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\VehicleBrand\Application\RestoreVehicleBrandUseCase;
use Src\Admin\VehicleBrand\Infrastructure\Repositories\EloquentVehicleBrandRepository;

final class RestoreVehicleBrandController
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
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $restoreVehicleBrandUseCase = new RestoreVehicleBrandUseCase($this->repository);
        $restoreVehicleBrandUseCase->__invoke( $id );
    }
}
