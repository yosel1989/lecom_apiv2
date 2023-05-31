<?php


namespace Src\Admin\VehicleBrand\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleBrand\Application\UpdateVehicleBrandUseCase;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;
use Src\Admin\VehicleBrand\Infrastructure\Repositories\EloquentVehicleBrandRepository;

final class UpdateVehicleBrandController
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
    public function __invoke(Request $request): ?VehicleBrand
    {
        $id = $request->id;
        $b_name = $request->input('name');
        $updateVehicleBrandUseCase = new UpdateVehicleBrandUseCase($this->repository);
        return $updateVehicleBrandUseCase->__invoke( $id, $b_name );
    }
}
