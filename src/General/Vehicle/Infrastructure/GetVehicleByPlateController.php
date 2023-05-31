<?php


namespace Src\General\Vehicle\Infrastructure;


use Illuminate\Http\Request;
use Src\General\Vehicle\Application\GetVehicleByPlateUseCase;
use Src\General\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class GetVehicleByPlateController
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
        $plate = $request->plate;
        $idClient = $request->idClient;

        $useCase = new GetVehicleByPlateUseCase($this->repository);
        return $useCase->__invoke($plate, $idClient);
    }
}
