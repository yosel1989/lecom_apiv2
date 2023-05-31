<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;


use Illuminate\Http\Request;
use Src\VehicleTicketing\Ticket\Application\GetActualTurnByIdVehicleUseCase;
use Src\VehicleTicketing\Ticket\Application\GetTicketCollectionByDateByVehicleByTurnUseCase;
use Src\VehicleTicketing\Ticket\Application\GetTicketCollectionByUserOfDateUseCase;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLatitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLongitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketTurn;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

final class GetTicketCollectionExpiredByDateByVehicleByTurnController
{
    private $repository;

    /**
     * GetTicketCollectionByUserOfDateController constructor.
     * @param EloquentTicketRepository $repository
     */
    public function __construct( EloquentTicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ) : array
    {
        $ticketLatitude = new TicketLatitude($request->input('latitude'));
        $ticketLongitude = new TicketLongitude($request->input('longitude'));
        $ticketIdVehicle = new TicketIdVehicle($request->input('idVehicle'));
        $today = new \DateTime('now');

        $getActualTurnByIdVehicleUseCase = new GetActualTurnByIdVehicleUseCase($this->repository);
        $turn = $getActualTurnByIdVehicleUseCase->__invoke( $request->input('idVehicle') );

        if(!$turn){
            return [];
        }

        $turn = new TicketTurn($turn);

        $getTicketCollectionByDateByVehicleByTurnUseCase = new GetTicketCollectionByDateByVehicleByTurnUseCase($this->repository);
        $vehicleCollection = $getTicketCollectionByDateByVehicleByTurnUseCase->__invoke($today->format('Y-m-d'),$ticketIdVehicle,$turn);

        return Ticket::filterTicketsCollectionByDefeated($vehicleCollection,$ticketLatitude,$ticketLongitude);

    }
}
