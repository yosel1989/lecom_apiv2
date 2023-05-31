<?php


namespace Src\General\Vehicle\Infrastructure;


use Illuminate\Http\Request;
use Src\General\Vehicle\Application\GetVehicleUseCase;
use Src\General\Vehicle\Domain\Vehicle;
use Src\General\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class GetVehicleController
{
    private $repository;

    public function __construct(EloquentVehicleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $vehicleId = $request->id;

        $getVehicleUseCase = new GetVehicleUseCase($this->repository);
        return $getVehicleUseCase->__invoke($vehicleId);
    }
}
