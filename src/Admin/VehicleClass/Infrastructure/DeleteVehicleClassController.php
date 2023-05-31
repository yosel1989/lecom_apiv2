<?php


namespace Src\Admin\VehicleClass\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleClass\Application\DeleteVehicleClassUseCase;
use Src\Admin\VehicleClass\Infrastructure\Repositories\EloquentVehicleClassRepository;

final class DeleteVehicleClassController
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
        $deleteVehicleClassUseCase = new DeleteVehicleClassUseCase($this->repository);
        $deleteVehicleClassUseCase->__invoke( $id );
    }
}
