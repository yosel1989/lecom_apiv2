<?php


namespace Src\Admin\VehicleClass\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleClass\Application\TrashVehicleClassUseCase;
use Src\Admin\VehicleClass\Infrastructure\Repositories\EloquentVehicleClassRepository;

final class TrashVehicleClassController
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
        $trashVehicleClassUseCase = new TrashVehicleClassUseCase($this->repository);
        $trashVehicleClassUseCase->__invoke( $id );
    }
}
