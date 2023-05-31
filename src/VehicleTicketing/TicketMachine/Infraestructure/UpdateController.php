<?php


namespace Src\VehicleTicketing\TicketMachine\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Admin\Vehicle\Application\FindUseCase;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;
use Src\VehicleTicketing\TicketMachine\Application\UpdateUseCase;
use Src\VehicleTicketing\TicketMachine\Infraestructure\Repositories\EloquentTicketMachineRepository;

final class UpdateController
{
    private $repository;
    private $vehiculeRepository;

    public function __construct(EloquentTicketMachineRepository $repository, EloquentVehicleRepository $vehiculeRepository)
    {
        $this->repository = $repository;
        $this->vehiculeRepository = $vehiculeRepository;
    }

    public function __invoke(Request $request): void
    {
        $user = Auth::user();
        $id = $request->id;
        $imei = $request->input('imei');
        $idVehicle = $request->input('idVehicle');

        $vehiculeUsecase = new FindUseCase($this->vehiculeRepository);
        $vehicle = $vehiculeUsecase->__invoke($idVehicle);

        $useCase = new UpdateUseCase($this->repository);
        $useCase->__invoke(
             $id,
             $imei,
             $vehicle->getIdClient()->value(),
             $idVehicle,
             $user->getId()
        );
    }
}
