<?php


namespace Src\Admin\VehicleClass\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\VehicleClass\Application\RestoreVehicleClassUseCase;
use Src\Admin\VehicleClass\Infrastructure\Repositories\EloquentVehicleClassRepository;

final class RestoreVehicleClassController
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
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $restoreVehicleClassUseCase = new RestoreVehicleClassUseCase($this->repository);
        $restoreVehicleClassUseCase->__invoke( $id );
    }
}
