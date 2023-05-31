<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\General\Vehicle\Application\GetVehiclesByUserUseCase;
use Src\General\Vehicle\Domain\Vehicle;
use Src\General\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;
use Src\VehicleTicketing\Ticket\Application\GetTicketCollectionByUserOfDateUseCase;
use Src\VehicleTicketing\Ticket\Application\GetTicketProductionByDateOfFleetUseCase;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

final class GetTicketProductionByDateOfFleetController
{

    private $repository;
    /**
     * @var EloquentVehicleRepository
     */
    private $vehicleRepository;

    /**
     * GetTicketCollectionByUserOfDateController constructor.
     * @param EloquentTicketRepository $repository
     * @param EloquentVehicleRepository $vehicleRepository
     */
    public function __construct( EloquentTicketRepository $repository, EloquentVehicleRepository $vehicleRepository )
    {
        $this->repository = $repository;
        $this->vehicleRepository = $vehicleRepository;
    }

    public function __invoke( Request $request ) : array
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $idUser = Auth::user()->id;

        $getVehiclesByUserUseCase = new GetVehiclesByUserUseCase($this->vehicleRepository);
        $vehicles = $getVehiclesByUserUseCase->__invoke($idUser);
        $arrIdVehicle = Vehicle::getIdList( $vehicles );

        $getTicketProductionByDateOfFleetUseCase = new GetTicketProductionByDateOfFleetUseCase($this->repository);
        return $getTicketProductionByDateOfFleetUseCase->__invoke($start,$end,$arrIdVehicle);

    }
}
