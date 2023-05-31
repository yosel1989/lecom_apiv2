<?php


namespace Src\Admin\VehicleBrand\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleBrand\Application\DeleteVehicleBrandUseCase;
use Src\Admin\VehicleBrand\Application\TrashVehicleBrandUseCase;
use Src\Admin\VehicleBrand\Infrastructure\Repositories\EloquentVehicleBrandRepository;

final class TrashVehicleBrandController
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
        $trashVehicleBrandUseCase = new TrashVehicleBrandUseCase($this->repository);
        $trashVehicleBrandUseCase->__invoke( $id );
    }
}
