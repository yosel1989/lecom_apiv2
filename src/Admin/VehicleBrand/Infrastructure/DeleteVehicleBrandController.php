<?php


namespace Src\Admin\VehicleBrand\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleBrand\Application\DeleteVehicleBrandUseCase;
use Src\Admin\VehicleBrand\Infrastructure\Repositories\EloquentVehicleBrandRepository;

final class DeleteVehicleBrandController
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
        $deleteVehicleBrandUseCase = new DeleteVehicleBrandUseCase($this->repository);
        $deleteVehicleBrandUseCase->__invoke( $id );
    }
}
